<?php

namespace Hunter;

class Status
{
    const NO_VERDICT = 0;
    const SUBMISSION_ERROR = 10;
    const CANT_BE_JUDGED = 15;
    const IN_QUEUE = 20;
    const COMPILATION_ERROR = 30;
    const RESTRICTED_FUNCTION = 35;
    const RUNTIME_ERROR = 40;
    const OUTPUT_LIMIT = 45;
    const TIME_LIMIT = 50;
    const MEMORY_LIMIT = 60;
    const WRONG_ANSWER = 70;
    const PRESENTATION_ERROR = 80;
    const ACCEPTED = 90;
}