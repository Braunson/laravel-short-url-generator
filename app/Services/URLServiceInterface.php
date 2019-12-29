<?php

namespace App\Services;

interface URLServiceInterface
{
    /**
     * Generate a hash for a given string
     *
     * @param string $url
     */
    public function generate(string $url);

    /**
     * Create a new URL
     *
     * @param mixed
     */
    public function create(array $post_data);

    /**
     * Get's a link by it's hash
     *
     * @param string
     */
    public function get($hash);

    /**
     * Get's all urls.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a url.
     *
     * @param string
     */
    public function delete($hash);

    /**
     * Updates a url.
     *
     * @param string
     * @param array
     */
    public function update($hash, array $post_data);

    /**
     * Adds a new visit to the URL
     *
     * @param URL $url
     */
    public function recordVisit($url);
}
