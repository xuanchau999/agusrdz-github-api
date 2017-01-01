<?php

use AgusRdz\GitHub\GitHubManager;

class GitHubApiTest extends TestCase {

    protected $api;

    public function setUp()
    {
        $this->api = new GitHubManager();
    }

    /**
     * @test Attempt get a valid user profile
     */
    public function testGetValidUserProfile()
    {

        $username = 'AgusRdz';
        $response = $this->api->getProfile($username);
        $expected = "https://api.github.com/users/{$username}";
        $this->assertEquals($expected, $response['url']);
    }

    /**
     * @test Attempt get an invalid user profile
     */
    public function testGetInValidUserProfile()
    {
        $username = 'AgusRdzFake';
        $response = $this->api->getProfile($username);
        $this->assertEquals('Not Found', $response);
    }

    /**
     * @test Attempt get the followers of a valid user profile
     */
    public function testGetValidUserFollowers()
    {
        $username = 'AgusRdz';
        $response = $this->api->getFollowers($username);
        $this->assertNotNull($response);
    }

    /**
     * @test Attempt get the followers of an invalid user profile
     */
    public function testGetInValidUserFollowers()
    {
        $username = 'AgusRdzFake';
        $response = $this->api->getFollowers($username);
        $this->assertEquals('Not Found', $response);
    }

    /**
     * @test Attempt get the repositories of a valid user profile
     */
    public function testGetValidUserRepos()
    {
        $username = 'AgusRdz';
        $response = $this->api->getRepositories($username);
        $this->assertNotNull($response);
    }

    /**
     * @test Attempt get the repositories of an invalid user profile
     */
    public function testGetInValidUserRepos()
    {
        $username = 'AgusRdzFake';
        $response = $this->api->getRepositories($username);
        $this->assertEquals('Not Found', $response);
    }

    /**
     * @test Attempt get the commits of specified repository of a valid user profile
     */
    public function testGetValidCommitsByRepo()
    {
        $username = 'AgusRdz';
        $repo = 'futureed-oauth2';
        $response = $this->api->getCommitsByRepository($username, $repo);
        $expected = "https://api.github.com/users/{$username}";
        $this->assertNotNull($response);
    }

    /**
     * @test Attempt get the commits of specified repository of an invalid user profile
     */
    public function testGetInvalidCommitsByRepo()
    {
        $username = 'AgusRdzFake';
        $repo = 'futureed-oauth2Fake';
        $response = $this->api->getCommitsByRepository($username, $repo);
        $this->assertEquals('Not Found', $response);
    }

    /**
     * @test Attempt get the total commits by user
     */
    public function testGetTotalCommitsByUser()
    {
        $username = 'AgusRdz';
        $response = $this->api->getTotalCommits($username);
        $this->assertInternalType("int", $response);
    }

}
