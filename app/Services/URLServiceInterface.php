<?php

namespace App\Services;

interface URLServiceInterface
{
    /**
     * Generate a hash for a given string
     *
     * @param String $url
     */
    public function generate($url);

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
     * Adds a new view to the URL
     *
     * @param string $hash
     */
    public function addView($hash);
}
