<?php

namespace App\Enums;

enum JobApplicationStatus: string
{
    //
    case  Pending = 'pending';
    case  ShortListed = 'shortlisted';
    case WaitingInterview  = 'waiting_interview';
    case  Accepted = 'accepted';
    case Rejected = 'rejected';
    case Withdrawn  = 'withdrawn';
}
