<x-layout>
    <h2>Legal Disclaimer and Responsibilities</h2>

    <p>At {{ config('app.name') }}, we provide a tool that enables users to download video and audio content from various sources, including YouTube. While the tool itself is built for general purposes and can be used for a variety of legitimate activities, it is important to note that downloading content from YouTube or other platforms may violate their terms of service.</p>

    <p>By using this service, you agree to comply with the terms and conditions set forth by the platforms you are downloading from. For example, YouTube’s Terms of Service prohibit the downloading of videos unless a download button or feature is provided by the platform (such as YouTube Premium). As a user, it is your responsibility to ensure that any content you download or access via this service is done so in compliance with the platform’s rules and regulations.</p>

    <h2 class="pt-5">User Responsibility</h2>

    <p>The system provided by {{ config('app.name') }} is a neutral tool designed to facilitate video and audio downloading for personal use, educational purposes, or other legal activities. We do not encourage or promote any illegal activity. We strongly advise users to familiarize themselves with the terms of service of the platforms they interact with and ensure that their actions are in compliance with relevant laws, including copyright laws.</p>

    <p>In some cases, downloading content for personal, non-commercial use may be covered under fair use or fair dealing exceptions in certain jurisdictions, but this is subject to the specific laws in your country. If you are unsure whether your usage of downloaded content violates any laws or terms, we recommend consulting with a legal professional.</p>

    <h2 class="pt-5">Risk of Enforcement</h2>

    <p>Please be aware that platforms like YouTube have the right to enforce their Terms of Service, which may include issuing DMCA takedown notices or taking actions against user accounts that violate their policies. While we provide this service, we do not control how content is handled on third-party platforms, and any legal or administrative action taken by those platforms is the responsibility of the user.</p>

    <p>By using this service, you acknowledge that you understand the legal implications of downloading content and agree to assume all risks associated with it.
        {{ config('app.name') }} is not liable for any legal consequences that may arise from your use of this service.</p>
<div class="py-6">
    <a href="{{ route('form') }}"
       class="w-full block bg-cranleigh hover:bg-cranleigh text-white font-bold p-3 rounded-lg transition text-center">
        Carry On... just download a video
    </a>
</div>
</x-layout>
