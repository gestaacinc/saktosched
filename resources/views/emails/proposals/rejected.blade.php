<x-mail::message>
# Update on Your Schedule Proposal

Hello {{ $proposal->proposer_name }},

Thank you for submitting a proposal for an assessment in **{{ $proposal->qualification->title }}**.

Unfortunately, we are unable to approve your proposed schedule for **{{ $proposal->proposed_date->format('F j, Y') }}** at this time.

**Reason:**<br>
*{{ $proposal->rejection_reason }}*

We encourage you to propose a different date or join one of our other pending schedules. Please feel free to contact us if you have any questions.

Regards,<br>
{{ config('app.name') }}
</x-mail::message>