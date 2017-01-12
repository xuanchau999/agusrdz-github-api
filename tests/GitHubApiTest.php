<?php

use AgusRdz\GitHub\GitHubManager;

class GitHubApiTest extends TestCase {

    protected $api;
    protected $client_id;
    protected $client_secret;
    protected $username;
    protected $usernameFake;

    public function setUp()
    {
        $this->api = new GitHubManager();
        $this->client_id = '689883e12c57c17f13a2';
        $this->client_secret = '119e7707649dfca9c19ce221a50fbdb73bad18b2';
        $this->username = 'AgusRdz';
        $this->usernameFake = 'AgusRdzFake';
    }

    /**
     * @test Attempt get a valid user profile
     */
    public function testGetValidUserProfile()
    {
        $response = $this->api->getProfile($this->username, $this->client_id, $this->client_secret);
        $expected = "https://github.com/{$this->username}";
        $this->assertEquals($expected, $response['html_url']);
    }

    /**
     * @test Attempt get the followers of a valid user profile
     */
    public function testGetValidUserFollowers()
    {
        $response = $this->api->getFollowers($this->username, $this->client_id, $this->client_secret);
        $this->assertNotNull($response);
    }

    /**
     * @test Attempt get the repositories of a valid user profile
     */
    public function testGetValidUserRepos()
    {
        $response = $this->api->getRepositories($this->username, $this->client_id, $this->client_secret);
        $this->assertNotNull($response);
    }

    /**
     * @test Attempt get the commits of specified repository of a valid user profile
     */
    public function testGetValidCommitsByRepo()
    {
        $repo = 'futureed-oauth2';
        $response = $this->api->getCommitsByRepository($this->username, $repo, $this->client_id, $this->client_secret);
        $expected = "https://api.github.com/users/{$this->username}";
        $this->assertNotNull($response);
    }

    /**
     * @test Attempt get the total commits by user
     */
    public function testGetTotalCommitsByUser()
    {
        $response = $this->api->getTotalCommits($this->username, $this->client_id, $this->client_secret);
        $this->assertInternalType("int", $response);
    }

}
