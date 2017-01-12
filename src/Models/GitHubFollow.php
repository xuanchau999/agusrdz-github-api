<?php
namespace AgusRdz\GitHub\Models;

use Jenssegers\Model\Model;

class GitHubFollow extends Model
{
	protected $fillable = ['login', 'avatar_url', 'html_url'];
}