@props(['class' => ''])

<svg viewBox="0 0 200 40" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class]) }}>
    <rect x="2" y="4" width="32" height="32" rx="6" fill="#FCD535"/>
    <text x="18" y="27" text-anchor="middle" font-family="Instrument Sans, sans-serif" font-weight="700" font-size="18" fill="#181a20">E</text>
    <text x="44" y="27" font-family="Instrument Sans, sans-serif" font-weight="700" font-size="20" fill="#FCD535">Edu</text>
    <text x="91" y="27" font-family="Instrument Sans, sans-serif" font-weight="700" font-size="20" fill="#eaecef">Grade</text>
</svg>
