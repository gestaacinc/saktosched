<x-mail::message>
# Schedule Proposal Approved!

Hello {{ $proposal->proposer_name }},

Great news! Your proposal for an assessment in **{{ $proposal->qualification->title }}** on **{{ $proposal->proposed_date->format('F j, Y') }}** has been approved.

A new pending schedule has been created, and your slot has been reserved. The schedule will be officially confirmed once it reaches the 10-person quota.

Thank you for choosing our assessment center.

Regards,<br>
{{ config('app.name') }}
</x-mail::message>