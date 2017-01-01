<?php
namespace AgusRdz\GitHub\Contracts;

interface GitHub
{
    /**
     * Get user profile
     * @param  string $username
     */
    public function getProfile($username);

    /**
     * Get followers of user
     * @param @param  string $username
     */
    public function getFollowers($username);

    /**
     * Get all user repositories
     * @param  string $username
     */
    public function getRepositories($username);

    /**
     * Get all commits on the specified repository
     * @param  string $username
     * @param  string $repository
     */
    public function getCommitsByRepository($username, $repository);

    /**
     * Get total number of commits on public repositories
     * @param  string $username
     */
    public function getTotalCommits($username);
}
