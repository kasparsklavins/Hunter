[![Build Status](https://scrutinizer-ci.com/g/kasparsklavins/Hunter/badges/build.png?b=master)](https://scrutinizer-ci.com/g/kasparsklavins/Hunter/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/kasparsklavins/Hunter/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/kasparsklavins/Hunter/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/kasparsklavins/Hunter/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/kasparsklavins/Hunter/?branch=master)

# Introduction
Hunter is an easy to use [uHunt](http://uhunt.felix-halim.net/api) wrapper to receive information from [UVa's online judge](http://uva.onlinejudge.org/).

Hunter is licensed under the MIT License - see the LICENSE file for details.

# Basic Usage
```PHP
use Hunter\Hunter;

require "vendor/autoload.php";

$hunter = new Hunter();

echo $hunter->getIdFromUsername("Kaspars");
```
# Installing
## With Composer
The easiest and recommended method to install Hunter is via composer.

Use the following command to install with composer.
```
$ composer require kaspars/hunter
```
If you wish you can create the following composer.json file and run composer install to install it.
```
{
   "require": {
      "kaspars/hunter": "~1.0"
   }
}
```
## Direct Download
First of all, you really should use composer.. But if you insist, then just copy the content from `src` folder into your project

# Data Format
All data is returned as an associated array.
## Problem format
* `id` Problem ID
* `number` Problem number
* `title` Problem title
* `dacu` Number of distinct accepted users
* `bestRuntime` Best runtime in milliseconds of an _Accepted Submission_
* `verdicts` An array given verdicts
    * `Hunter\Status::NO_VERDICT` Number of _No Verdict Given_ (can be ignored)
    * `Hunter\Status::SUBMISSION_ERROR` Number of _Submission Error_
    * `Hunter\Status::CANT_BE_JUDGED` Number of _Can't be Judged_
    * `Hunter\Status::IN_QUEUE` Number of _In Queue_
    * `Hunter\Status::COMPILATION_ERROR` Number of _Compilation Error_
    * `Hunter\Status::RESTRICTED_FUNCTION` Number of _Restricted Function_
    * `Hunter\Status::RUNTIME_ERROR` Number of _Runtime Error_
    * `Hunter\Status::OUTPUT_LIMIT` Number of _Output Limit Exceeded_
    * `Hunter\Status::TIME_LIMIT` Number of _Time Limit Exceeded_
    * `Hunter\Status::MEMORY_LIMIT` Number of _Memory Limit Exceeded_
    * `Hunter\Status::WRONG_ANSWER` Number of _Wrong Answer_
    * `Hunter\Status::PRESENTATION_ERROR` Number of _Presentation Error_
    * `Hunter\Status::ACCEPTED` Number of _Accepted_
* `limit` Problem runtime limit in milliseconds
* `status` Problem Status
   * `Hunter\Status::UNAVAILABLE` Unavailable
   * `Hunter\Status::Normal` Normal
   * `Hunter\Status::SPECIAL_JUDGE` A special judging program is used.
* `rejudged` Last time _(unix timestamp)_ the problem was rejudged, `null` if never.

## Submission format
* `id` Submission`s ID
* `user` User ID
* `name` User's full name
* `username` User`s username
* `problem` Problem's ID
* `verdict` Given verdict
    * `Hunter\Status::SUBMISSION_ERROR` Submission Error
    * `Hunter\Status::CANT_BE_JUDGED` Can't be Judged
    * `Hunter\Status::IN_QUEUE` In Queue
    * `Hunter\Status::COMPILATION_ERROR` Compilation Error
    * `Hunter\Status::RESTRICTED_FUNCTION` Restricted Function
    * `Hunter\Status::RUNTIME_ERROR` Runtime Error
    * `Hunter\Status::OUTPUT_LIMIT` Output Limit Exceeded
    * `Hunter\Status::TIME_LIMIT` Time Limit Exceeded
    * `Hunter\Status::MEMORY_LIMIT` Memory Limit Exceeded
    * `Hunter\Status::WRONG_ANSWER` Wrong Answer
    * `Hunter\Status::PRESENTATION_ERROR` Presentation Error
    * `Hunter\Status::ACCEPTED` Accepted
* `language` Language in which submission was written
    * `Hunter\Language::ANSI_C` Ansi C
    * `Hunter\Language::Java` Java
    * `Hunter\Language::CPLUSPLUS` C++
    * `Hunter\Language::PASCAL` Pascal
    * `Hunter\Language::CPLUSPLUS11` C++11
* `runtime` Runtime in milliseconds
* `rank` Submission rank, compared to all
* `time` Submission unix timestamp

## Ranklist format
* `id` User`s ID
* `name` User`s name
* `username` User`s username
* `rank` User's rank
* `accepted` The number of accepted problems
* `submissions` The number of submissions
* `activity` Array of user's activity
    * `Hunter\Activity::DAYS` Activity in the last 2 days
    * `Hunter\Activity::WEEK` Activity in the last 7 days
    * `Hunter\Activity::MONTH` Activity in the last 31 days
    * `Hunter\Activity::QUARTER` Activity in the last 3 months
    * `Hunter\Activity::YEAR` Activity in the last year

#API
##getIdFromUsername(string $username)
Convert the given `$username` to a UVa ID.

Returns either the id, or `null` if not found
```PHP
$hunter = new Hunter\Hunter();
echo $hunter->getIdFromUsername("Kaspars"); //343417
echo $hunter->getIdFromUsername("Foobar"); // null
```
# Examples
## problems(void)
Returns an array of available UVa problems
```PHP
$hunter = new Hunter\Hunter();
var_dump($hunter->problems());
```
## problem(int $id, string $type = "id")
Retrieved data of a specific problem
```PHP
$hunter = new Hunter\Hunter();
var_dump($hunter->problem(36));
var_dump($hunter->problem(100, "num"));
```
## problemSubmissions(array|int $problemIDS, int $start = 0, int $end = 2^31)
View submissions to specific problems on a given submission date range.
`$start` and `$end` are unix timestamps
```PHP
$hunter = new Hunter\Hunter();
var_dump($hunter->problemSubmissions(36));
var_dump($hunter->problemSubmissions(array(36,37)));
```
## problemRanklist(int $problemID, int $rank = 1, int $count = 100)
Returns submissions to a problem ranked from $rank to $rank + $count - 1.
```PHP
$hunter = new Hunter\Hunter();
var_dump($hunter->problemRanklist(36));
```
## userProblemRanklist(int $problemID, int $userID, int $above = 10, int $below = 10)
Returns nearby submissions (by runtime) for a particular user submission to a problem.
```PHP
$hunter = new Hunter\Hunter();
var_dump($hunter->userProblemRanklist(36, 343417));
```
## userSubmissions(int $userID, int $min = null)
Returns all of the submissions of a particular user.

if `$min` is specified, only submissions with ID larger than `$min` will be returned.
```PHP
$hunter = new Hunter\Hunter();
var_dump($hunter->userSubmissions(343417));
```
## userLatestSubmissions(int $userID, int $count = 10)
Returns the last $count submissions of a particular user.
```PHP
$hunter = new Hunter\Hunter();
var_dump($hunter->userLatestSubmissions(343417));
```
## userProblemSubmissions(array|int $userIDs, array|int $problemIDs, int $min, string $type = "id")
Returns all the submissions of the users on specific problems.

Possible `$type` values are _id_ and _num_. This changes whether you pass problem id's or problem num's as the second argument.
```PHP
$hunter = new Hunter\Hunter();
var_dump($hunter->userProblemSubmissions(343417, 36);
```
## userSolvedProblems(array|int $userIDs)
Get The Bit-Encoded-Problem IDs that Has Been Solved by Some Authors.
```PHP
$hunter = new Hunter\Hunter();
var_dump($hunter->userSolvedProblems(343417));
```
## userRanklist(int $userID, int $above = 10, int $below = 10)
Returns the user's ranklist and their closest neighbors.
```PHP
$hunter = new Hunter\Hunter();
var_dump($hunter->userRanklist(343417, 10, 10));
```
## ranklist(int $rank = 1, int $count = 10)
Global ranklist, starteing from `$rank` to `$rank+$count`
```PHP
$hunter = new Hunter\Hunter();
var_dump($hunter->ranklist(1, 100));
```
## setSource(string $source)
Change the source of API data. The default is _http://uhunt.felix-halim.net/api/_, another valid source is _http://icpcarchive.ecs.baylor.edu/uhunt/api/_. But you can switch to any source that has the same data format.
```PHP
$hunter = new Hunter\Hunter();
var_dump($hunter->setSource('http://icpcarchive.ecs.baylor.edu/uhunt/api/'));
```
#getSource()
Returns the current used API source.
```PHP
$hunter = new Hunter\Hunter();
var_dump($hunter->getSource());
```
