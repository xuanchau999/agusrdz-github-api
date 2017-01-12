<?php
namespace AgusRdz\GitHub\Models;

use Jenssegers\Model\Model;

class GitHubRepository extends Model
{
	protected $fillable = ['name', 'full_name', 'private', 'html_url', 'description', 'created_at',
		'updated_at', 'pushed_at', 'clone_url', 'svn_url', 'homepage', 'language'];
}