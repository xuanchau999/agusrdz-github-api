<?php
namespace AgusRdz\GitHub;

use GuzzleHttp\Client;
use AgusRdz\GitHub\Contracts\GitHub as GitHubContract;
use AgusRdz\GitHub\Models\GitHubUser;
use AgusRdz\GitHub\Models\GitHubFollow;
use AgusRdz\GitHub\Models\GitHubRepository;
use Illuminate\Support\Collection;

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
    public function getProfile($username, $client_id, $client_secret)
    {
        $url = $this->uri.$username.'?client_id='.$client_id.'&client_secret='.$client_secret;
        try {
            $response = $this->client->request('GET', $this->uri.$username,
                                                ['headers' =>
                                                    ['Accept' => 'application/vnd.github.v3+json']
                                                ]);
            $user = new GitHubUser();
            $user->fill(json_decode($response->getBody(), true));
            return $user;
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            throw new \Exception($responseBodyAsString, 1);
        }
    }

    /**
     * Get followers of user
     * @param @param  string $username
     * @return mixed
     */
    public function getFollowers($username, $client_id, $client_secret)
    {
        $url = $this->uri.$username.'/followers?client_id='.$client_id.'&client_secret='.$client_secret;
        try {
            $response = $this->client->request('GET', $this->uri.$username.'/followers',
                                                ['headers' =>
                                                    ['Accept' => 'application/vnd.github.v3+json']
                                                ]);
            $array = json_decode($response->getBody(), true);
            $followers = [];
            foreach ($array as $element) {
                $follower = new GitHubFollow();
                $follower->fill($element);
                $followers[] = $follower;
            }
            $collection = collect($followers);
            return $collection;
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            throw new \Exception($responseBodyAsString, 1);
        }
    }

    /**
     * Get following users by user
     * @param @param  string $username
     * @return mixed
     */
    public function getFollowings($username, $client_id, $client_secret)
    {
        $url = $this->uri.$username.'/following?client_id='.$client_id.'&client_secret='.$client_secret;
        try {
            $response = $this->client->request('GET', $url,
                                                ['headers' =>
                                                    ['Accept' => 'application/vnd.github.v3+json']
                                                ]);
            $array = json_decode($response->getBody(), true);
            $followings = [];
            foreach ($array as $element) {
                $following = new GitHubFollow();
                $following->fill($element);
                $followings[] = $following;
            }
            $collection = collect($followings);
            return $collection;
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            throw new \Exception($responseBodyAsString, 1);
        }
    }

    /**
     * Get all user repositories
     * @param  string $username
     * @return mixed
     */
    public function getRepositories($username, $client_id, $client_secret)
    {
        $url = $this->uri.$username.'/repos?client_id='.$client_id.'&client_secret='.$client_secret;
        try {
            $response = $this->client->request('GET', $this->uri.$username.'/repos',
                                                ['headers' =>
                                                    ['Accept' => 'application/vnd.github.v3+json']
                                                ]);
            $array = json_decode($response->getBody(), true);
            $repositories = [];
            foreach ($array as $element) {
                $repository = new GitHubRepository();
                $repository->fill($element);
                $repositories[] = $repository;
            }
            $collection = collect($repositories);
            return $collection;
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            throw new \Exception($responseBodyAsString, 1);
        }
    }

    /**
     * Get all commits on the specified repository
     * @param  string $username
     * @param  string $repository
     * @return mixed
     */
    public function getCommitsByRepository($username, $repository, $client_id, $client_secret)
    {
        $uri = 'https://api.github.com/repos/'.$username.'/'.$repository.'/commits?client_id='.$client_id.'&client_secret='.$client_secret;
        try {
            $response = $this->client->request('GET', $uri,
                                                ['headers' =>
                                                    ['Accept' => 'application/vnd.github.v3+json']
                                                ]);
            return json_decode($response->getBody(), true);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            $json = json_decode($responseBodyAsString, true);
            if($json['message'] === 'Git Repository is empty.')
                return 0;

            throw new \Exception($responseBodyAsString, 1);
        }
    }

    /**
     * Get total number of commits on public repositories
     * @param  string $username
     * @return mixed
     */
    public function getTotalCommits($username, $client_id, $client_secret)
    {
        $repositories = $this->getRepositories($username, $client_id, $client_secret);
        $commits = 0;
        foreach ($repositories as $repository) {
            $currentRepo = $this->getCommitsByRepository($username, $repository['name'], $client_id, $client_secret);
            if(is_array($currentRepo)){
                $commits = $commits + count($currentRepo);
            }
        }
        return $commits;
    }
}
