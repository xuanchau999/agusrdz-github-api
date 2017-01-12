<?php
namespace AgusRdz\GitHub\Models;

use Jenssegers\Model\Model;

class GitHubUser extends Model
{
	protected $fillable = ['login', 'avatar_url', 'html_url', 'name', 'blog', 'location', 'email', 'bio', 'public_repos', 'public_gists', 'followers', 'following', 'created_at'];
}