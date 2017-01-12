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
    protected $headers;

    public function __construct()
    {
        $this->client = new Client();
        $this->uri = 'https://api.github.com/users/';
        $this->headers = [
            'headers' => [
                [
                    'Accept' => 'application/vnd.github.v3+json',
                    'User-Agent' => 'Awesome-Octocat-App'
                ]
            ]
        ];
    }

    /**
     * Get user profile
     * @param  string $username
     * @return mixed
     */
    public function getProfile($username, $accessToken)
    {
        $url = $this->uri.$username.'?access_token='.$accessToken;
        try {
            $response = $this->client->request('GET', $url, $this->headers);
            $user = new GitHubUser();
            $user->fill(json_decode($response->getBody(), true));
            return $user;
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            throw new \Exception($response->getBody()->getContents(), 1);
        }
    }

    /**
     * Get followers of user
     * @param @param  string $username
     * @return mixed
     */
    public function getFollowers($username, $accessToken)
    {
        $url = $this->uri.$username.'/followers?access_token='.$accessToken;
        try {
            $response = $this->client->request('GET', $url, $this->headers);
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
            throw new \Exception($response->getBody()->getContents(), 1);
        }
    }

    /**
     * Get following users by user
     * @param @param  string $username
     * @return mixed
     */
    public function getFollowings($username, $accessToken)
    {
        $url = $this->uri.$username.'/following?access_token='.$accessToken;
        try {
            $response = $this->client->request('GET', $url, $this->headers);
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
            throw new \Exception($response->getBody()->getContents(), 1);
        }
    }

    /**
     * Get all user repositories
     * @param  string $username
     * @return mixed
     */
    public function getRepositories($username, $accessToken)
    {
        $url = $this->uri.$username.'/repos?access_token='.$accessToken;
        try {
            $response = $this->client->request('GET', $url, $this->headers);
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
            throw new \Exception($response->getBody()->getContents(), 1);
        }
    }

    /**
     * Get all commits on the specified repository
     * @param  string $username
     * @param  string $repository
     * @return mixed
     */
    public function getCommitsByRepository($username, $repository, $accessToken)
    {
        $url = 'https://api.github.com/repos/'.$username.'/'.$repository.'/commits?access_token='.$accessToken;
        try {
            $response = $this->client->request('GET', $url, $this->headers);
            return json_decode($response->getBody(), true);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $json = json_decode($response->getBody()->getContents(), true);
            if($json['message'] === 'Git Repository is empty.')
                return 0;

            throw new \Exception($response->getBody()->getContents(), 1);
        }
    }

    /**
     * Get total number of commits on public repositories
     * @param  string $username
     * @return mixed
     */
    public function getTotalCommits($username, $accessToken)
    {
        $repositories = $this->getRepositories($username, $accessToken);
        $commits = 0;
        foreach ($repositories as $repository) {
            $currentRepo = $this->getCommitsByRepository($username, $repository['name'], $accessToken);
            if(is_array($currentRepo)){
                $commits = $commits + count($currentRepo);
            }
        }
        return $commits;
    }
}
