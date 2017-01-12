<?php
namespace AgusRdz\GitHub\Contracts;

interface GitHub
{
    /**
     * Get user profile
     * @param  string $username
     */
    public function getProfile($username, $accessToken);

    /**
     * Get followers of user
     * @param @param  string $username
     */
    public function getFollowers($username, $accessToken);

    /**
     * Get followers of user
     * @param @param  string $username
     */
    public function getFollowings($username, $accessToken);

    /**
     * Get all user repositories
     * @param  string $username
     */
    public function getRepositories($username, $accessToken);

    /**
     * Get all commits on the specified repository
     * @param  string $username
     * @param  string $repository
     */
    public function getCommitsByRepository($username, $repository, $accessToken);

    /**
     * Get total number of commits on public repositories
     * @param  string $username
     */
    public function getTotalCommits($username, $accessToken);
}
