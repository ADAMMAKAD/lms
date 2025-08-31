<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Certificate</title>
    <style>
        @page { size: 930px 600px; margin: 0; }
        body { margin: 0; padding: 0; font-family: Arial, sans-serif; }
        .certificate-body { width: 930px; height: 600px; position: relative; background: #e7e7e7; }
        .element { position: absolute; }
    </style>
</head>
<body>
    <div class="certificate-body" @if($certificate->background) style="background-image: url('{{ asset($certificate->background) }}'); background-size: cover; background-position: center;" @endif>
        {{-- Site Logo --}}
        @if ($setting && $setting->logo)
            <div class="element" style="left: 50px; top: 30px;">
                <img src="{{ url($setting->logo) }}" alt="{{ $setting->app_name ?? 'Site Logo' }}" style="max-width: 150px; height: auto;">
            </div>
        @endif
        @if ($certificate->title)
            @php $titleItem = $certificateItems->where('element_id', 'title')->first(); @endphp
            <div id="title" class="element" style="font-size: 22px; font-weight: bold; color: black; width: 730px; text-align: center; @if($titleItem) left: {{ $titleItem->x_position }}px; top: {{ $titleItem->y_position }}px; @else left: 50%; transform: translateX(-50%); @endif">{{ $certificate->title }}</div>
        @endif
        @if ($certificate->sub_title)
            @php $subTitleItem = $certificateItems->where('element_id', 'sub_title')->first(); @endphp
            <div id="sub_title" class="element" style="font-size: 18px; color: black; width: 730px; text-align: center; @if($subTitleItem) left: {{ $subTitleItem->x_position }}px; top: {{ $subTitleItem->y_position }}px; @else left: 50%; transform: translateX(-50%); @endif">{{ $certificate->sub_title }}</div>
        @endif
        @if ($certificate->description)
            @php $descItem = $certificateItems->where('element_id', 'description')->first(); @endphp
            <div id="description" class="element" style="font-size: 16px; color: black; text-align: center; width: 730px; @if($descItem) left: {{ $descItem->x_position }}px; top: {{ $descItem->y_position }}px; @else left: 50%; transform: translateX(-50%); @endif">{!! clean(nl2br($certificate->description)) !!}</div>
        @endif
        @if ($certificate->signature)
            @php $sigItem = $certificateItems->where('element_id', 'signature')->first(); @endphp
            <div id="signature" class="element" style="@if($sigItem) left: {{ $sigItem->x_position }}px; top: {{ $sigItem->y_position }}px; @endif"><img src="{{ asset($certificate->signature) }}" alt="Signature" style="max-width: 200px; height: auto;"></div>
        @endif
    </div>
</body>
</html>
