<?php
namespace AgusRdz\GitHub;

use GuzzleHttp\Client;
use AgusRdz\GitHub\Contracts\GitHub as GitHubContract;

/**
 * This class handle the request to GitHub API only for get user information
 */
class GitHubManager implements GitHubContract
{
    protected $uri;
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
        $this->uri = 'https://api.github.com/users/';
    }

    /**
     * Get user profile
     * @param  string $username
     * @return mixed
     */
    public function getProfile($username)
    {
        try {
            $response = $this->client->request('GET', $this->uri.$username,
                                                ['headers' =>
                                                    ['Accept' => 'application/vnd.github.v3+json']
                                                ]);
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return 'Not Found';
        }
    }

    /**
     * Get followers of user
     * @param @param  string $username
     * @return mixed
     */
    public function getFollowers($username)
    {
        try {
            $response = $this->client->request('GET', $this->uri.$username.'/followers',
                                                ['headers' =>
                                                    ['Accept' => 'application/vnd.github.v3+json']
                                                ]);
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return 'Not Found';
        }
    }

    /**
     * Get all user repositories
     * @param  string $username
     * @return mixed
     */
    public function getRepositories($username)
    {
        try {
            $response = $this->client->request('GET', $this->uri.$username.'/repos',
                                                ['headers' =>
                                                    ['Accept' => 'application/vnd.github.v3+json']
                                                ]);
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return 'Not Found';
        }
    }

    /**
     * Get all commits on the specified repository
     * @param  string $username
     * @param  string $repository
     * @return mixed
     */
    public function getCommitsByRepository($username, $repository)
    {
        $uri = 'https://api.github.com/repos/'.$username.'/'.$repository.'/commits';
        try {
            $response = $this->client->request('GET', $uri,
                                                ['headers' =>
                                                    ['Accept' => 'application/vnd.github.v3+json']
                                                ]);
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return 'Not Found';
        }
    }

    /**
     * Get total number of commits on public repositories
     * @param  string $username
     * @return mixed
     */
    public function getTotalCommits($username)
    {
        $repositories = $this->getRepositories($username);
        $commits = 0;
        foreach ($repositories as $repository) {
            $currentRepo = $this->getCommitsByRepository($username, $repository['name']);
            if(is_array($currentRepo)){
                $commits = $commits + count($currentRepo);
            }
        }
        return $commits;
    }
}
