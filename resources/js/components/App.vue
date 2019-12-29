<template>

    <div class="flex items-center justify-center h-screen bg-gray-200">

        <div class="max-w-md w-full lg:flex">
            
            <div class="border-r border-b border-l border-grey-light lg:border-t lg:border-grey-light bg-white rounded p-5 flex flex-col justify-between leading-normal">
            
                <div class="mb-3">
                    <div class="text-black font-bold text-xl mb-2">Need to shorten a URL?</div>
                    <p class="text-grey-darker text-base">Drop the URL you want to shorten in the input below and hit the Shrink button. Magic will happen.</p>
                </div>

                <form class="w-full" v-on:submit.prevent="submit">
                    <div class="flex items-center">
                        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline-none rounded-r-none" id="url" type="url" placeholder="https://foo.bar" aria-label="URL" v-model="url">
                        <button class="flex-shrink-0 bg-gray-500 hover:bg-gray-700 text-white uppercase font-bold text-sm py-2 px-3 rounded focus:outline-none focus:shadow-outline-none rounded-l-none" type="submit">
                            Shrink
                        </button>
                    </div>

                    <div class="bg-red-100 border border-red-400 text-red-700 px-3 py-2 rounded relative mt-4" role="alert" v-if="messages.error.length !== 0">
                        <strong class="font-bold">Uhh..</strong>
                        <span class="block sm:inline">{{ this.messages.error }}</span>
                    </div>

                    <div class="bg-green-100 border border-green-400 text-green-700 px-3 py-2 rounded relative mt-4" role="alert" v-if="messages.success.length !== 0">
                        <span class="block sm:inline clipboard-text">{{ this.messages.success }}</span>
                        <span class="float-right">
                            <button type="button"
                                v-clipboard:copy="messages.success"
                                v-clipboard:success="onCopy"
                                v-clipboard:error="onError">
                                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAAAU0lEQVRIiWNgGOqAEcbIuDzxPyUGzdDNZ8QmzkSJocQAFmJdQi6gvw9ggFpxMnA+QHcJsQDd5zT3wagFoxaMWoCUk6ldisLAwJdFlJaqNPfB0AcAMyYRZ7mV80UAAAAASUVORK5CYII=">
                                </button>
                        </span>
                    </div>
                </form>


            </div>
        </div>

    </div>

</template>

<script>
    import VueClipboard from 'vue-clipboard2'
    Vue.use(VueClipboard)

    export default {
        mounted() {
            console.log('App mounted.')
        },

        data() {
            return {
                url: '',
                messages: {
                    error: '',
                    success: ''
                }
            }
        },

        methods: {

            /**
             * Function to validate the given URL
             * 
             * @param  {String} url
             * @return {Boolean}
             */
            validURL: function (url) {
                var re = /^(ftp|http|https):\/\/(([a-zA-Z0-9$\-_.+!*'(),;:&=]|%[0-9a-fA-F]{2})+@)?(((25[0-5]|2[0-4][0-9]|[0-1][0-9][0-9]|[1-9][0-9]|[0-9])(\.(25[0-5]|2[0-4][0-9]|[0-1][0-9][0-9]|[1-9][0-9]|[0-9])){3})|localhost|([a-zA-Z0-9\-\u00C0-\u017F]+\.)+([a-zA-Z]{2,}))(:[0-9]+)?(\/(([a-zA-Z0-9$\-_.+!*'(),;:@&=]|%[0-9a-fA-F]{2})*(\/([a-zA-Z0-9$\-_.+!*'(),;:@&=]|%[0-9a-fA-F]{2})*)*)?(\?([a-zA-Z0-9$\-_.+!*'(),;:@&=\/?]|%[0-9a-fA-F]{2})*)?(\#([a-zA-Z0-9$\-_.+!*'(),;:@&=\/?]|%[0-9a-fA-F]{2})*)?)?$/;

                return re.test(url)
            },
        
            /**
             * Submit data to the API endpoint
             *
             * @param  {Object} event
             * @param  {Object} payload
             * @return {Void}
             */
            submit: function(event) {
                // Validate the provided URL
                if (! this.validURL(this.url)) {
                    this.messages.success = '';
                    this.messages.error = 'Please provide a valid URL';

                    return false;
                }

                // Reset the error message
                this.messages.error = '';

                // Make the API call
                axios.post('/api/generate', { url: this.url })
                    .then((response) => {
                        // Set the success message to our new URL!
                        this.messages.success = response.data.link;

                        // Clear the url from the form
                        this.url = '';
                    })
                    .catch((response) => {
                        this.messages.error = 'Something went wrong, please try again..';
                    });
            },

            onCopy: function (e) {
                // alert('You just copied: ' + e.text)
            },

            onError: function (e) {
                this.messages.error = 'Failed to copy the URL, something went wrong, please try again.';
            }
        }
    }
</script>
