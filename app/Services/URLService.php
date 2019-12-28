<?php

namespace App\Services;

use App\URL;
use Vinkla\Hashids\HashidsManager;

class URLService implements URLServiceInterface
{
    protected $hashids;

    public function __construct(HashidsManager $hashids)
    {
        $this->hashids = $hashids;
    }

    /**
     * Generate a hash for a given string
     *
     * @param String $url
     * @return String
     */
    public function generate(String $url) : String
    {
        return $this->hashids->encode($url);
    }

    /**
     * Create a new URL
     *
     * @param array $post_data
     * @return Collection
     */
    public function create($post_data)
    {
        $hash = $this->hashids->encode($post_data->url);

        return URL::findOrFirst(array_merge($post_data, [
            'hash' => $hash
        ]));
    }

    /**
     * Get's a post by it's Hash
     *
     * @param string
     * @return Collection
     */
    public function get($hash)
    {
        return URL::whereHash($hash)->firstOrFail();
    }

    /**
     * Get's all URLs.
     *
     * @return Collection
     */
    public function all()
    {
        return URL::all();
    }

    /**
     * Deletes a URL.
     *
     * @param string
     */
    public function delete($hash)
    {
        URL::whereHash($hash)->destroy();
    }

    /**
     * Updates a URL.
     *
     * @param string
     * @param array
     */
    public function update($hash, array $post_data)
    {
        URL::whereHash($hash)->update($post_data);
    }

    /**
     * Increments the views column
     *
     * @param string $hash
     */
    public function addView($hash)
    {
        URL::whereHash($hash)->increment('views');
    }
}
