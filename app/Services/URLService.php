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
     * @param Array $post_data
     * @return Collection
     */
    public function create($post_data)
    {
        // Create the URL and hash it
        $url = URL::firstOrCreate($post_data);
        $url->hash = $this->hashids->encode($url->id);
        $url->save();

        return $url;
    }

    /**
     * Get's a post by it's Hash
     *
     * @param String
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
     * Increments the visits column
     *
     * @param URL $hash
     */
    public function recordVisit($url)
    {
        $url->increment('visits');
    }
}
