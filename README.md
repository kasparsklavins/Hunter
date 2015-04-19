#getIdFromUsername(string)
Convert Username to UserID
```PHP
$hunter = new Hunter\Hunter();
echo $hunter->getIdFromUsername("Kaspars"); //343417
```
#problems(void)
Returns the list of problems at UVa.
```PHP
$hunter = new Hunter\Hunter();
var_dump($hunter->problems("Kaspars"));
```
#problem(int, string)
View a specific problem.
```PHP
$hunter = new Hunter\Hunter();
var_dump($hunter->problem(36));
var_dump($hunter->problem(100, "num"));
```
#problemSubmissions(array, int, int)
View submissions to specific problems on a given submission date range.
```PHP
$hunter = new Hunter\Hunter();
var_dump($hunter->problemSubmissions(36));
var_dump($hunter->problemSubmissions(array(36,37)));
```
#problemRanklist(int, int, int)
Returns submissions to a problem ranked from $rank to $rank + $count - 1.
```PHP
$hunter = new Hunter\Hunter();
var_dump($hunter->problemRanklist(36));
```
#userProblemRanklist(int, int, int, int)
Returns nearby submissions (by runtime) for a particular user submission to a problem.
```PHP
$hunter = new Hunter\Hunter();
var_dump($hunter->userProblemRanklist(36, 343417));
```
#userSubmissions(int, int)
Returns all of the submissions of a particular user.
```PHP
$hunter = new Hunter\Hunter();
var_dump($hunter->userSubmissions(343417));
```
#userLatestSubmissions(int, int)
Returns the last $count submissions of a particular user.
```PHP
$hunter = new Hunter\Hunter();
var_dump($hunter->userLatestSubmissions(343417));
```
#userProblemSubmissions(array, array, int, string)
Returns all the submissions of the users on specific problems.
```PHP
$hunter = new Hunter\Hunter();
var_dump($hunter->userProblemSubmissions(343417, 36));
```
#userSolvedProblems(array)
Get The Bit-Encoded-Problem IDs that Has Been Solved by Some Authors.
```PHP
$hunter = new Hunter\Hunter();
var_dump($hunter->userSolvedProblems(343417));
```
#userRanklist(int, int, int)
Returns the user's ranklist and their neighbors.
```PHP
$hunter = new Hunter\Hunter();
var_dump($hunter->userRanklist(343417));
```
#ranklist(int, int)
Global ranklist.
```PHP
$hunter = new Hunter\Hunter();
var_dump($hunter->ranklist());
```
