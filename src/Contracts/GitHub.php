<?php
namespace AgusRdz\GitHub\Contracts;

interface GitHub
{
    /**
     * Get user profile
     * @param  string $username
     */
    public function getProfile($username, $client_id, $client_secret);

    /**
     * Get followers of user
     * @param @param  string $username
     */
    public function getFollowers($username, $client_id, $client_secret);

    /**
     * Get followers of user
     * @param @param  string $username
     */
    public function getFollowings($username, $client_id, $client_secret);

    /**
     * Get all user repositories
     * @param  string $username
     */
    public function getRepositories($username, $client_id, $client_secret);

    /**
     * Get all commits on the specified repository
     * @param  string $username
     * @param  string $repository
     */
    public function getCommitsByRepository($username, $repository, $client_id, $client_secret);

    /**
     * Get total number of commits on public repositories
     * @param  string $username
     */
    public function getTotalCommits($username, $client_id, $client_secret);
}
