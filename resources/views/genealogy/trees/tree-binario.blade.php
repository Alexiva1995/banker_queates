<div id="tree-body-2" class="tab-body d-none">
    <ul>
        <li class="baseli p-0">

            {{-- usuario principal --}}
            <a href="#" class="base">
                <div class="media">
                    @if ($base->gender == null || $base->gender == '0')
                        <img src="{{ asset('images/avatars-profile/1.png') }}" height="64" width="64"
                        class="rounded-circle align-self-center mr-1 di" alt="{{ $base->name }}"
                        title="{{ $base->name }}">
                    @else
                        <img src="{{ asset('images/avatars-profile/2.png') }}" height="64" width="64"
                        class="rounded-circle align-self-center mr-1 di" alt="{{ $base->name }}"
                        title="{{ $base->name }}">
                    @endif
                    <div class="media-body">
                        <h5 class="mt-0"> <b>{{ $base->name }}</b></h5>
                    </div>
                </div>
            </a>
            {{-- Nivel 1 --}}
            <ul>
                @foreach ($trees as $child)
                    <li>
                        @include('genealogy.component.subniveles', ['data' => $child])
                        @if (!empty($child->children))
                            {{-- nivel 2 --}}
                            <ul>
                                @foreach ($child->children as $child1)
                                    {{-- genera el lado binario derecho haciendo vacio --}}
                                    <li>
                                        @include('genealogy.component.subniveles', [
                                            'data' => $child1,
                                        ])
                                        @if (!empty($child1->children))
                                            {{-- nivel 3 --}}
                                            <ul class="d-none d-sm-table-cell">
                                                @foreach ($child1->children as $child2)
                                                    {{-- genera el lado binario derecho haciendo vacio --}}
                                                    <li>
                                                        @include('genealogy.component.subniveles', [
                                                            'data' => $child2,
                                                        ])
                                                        @if (!empty($child2->children))
                                                            <ul>
                                                                @foreach ($child2->children as $child3)
                                                                    <li>
                                                                        @include('genealogy.component.subniveles',
                                                                            ['data' => $child3])
                                                                        @if (5 <= $lastLevelActive->id)
                                                                            @if (!empty($child3->children))

                                                                                <div id="moreLevel" class="d-none">
                                                                                    <ul>
                                                                                        @foreach ($child3->children as $child4)
                                                                                            <li>
                                                                                                @include('genealogy.component.subniveles',
                                                                                                    [
                                                                                                        'data' => $child4,
                                                                                                    ])
                                                                                                @if (6 <= $lastLevelActive->id)
                                                                                                    @if (!empty($child4->children))
                                                                                                        <ul>
                                                                                                            @foreach ($child4->children as $child5)
                                                                                                                <li>
                                                                                                                    @include('genealogy.component.subniveles',
                                                                                                                        [
                                                                                                                            'data' => $child5,
                                                                                                                        ])
                                                                                                                    @if (7 <= $lastLevelActive->id)
                                                                                                                        @if (!empty($child5->children))
                                                                                                                            <ul>
                                                                                                                                @foreach ($child5->children as $child6)
                                                                                                                                    <li>
                                                                                                                                        @include('genealogy.component.subniveles',
                                                                                                                                            [
                                                                                                                                                'data' => $child6,
                                                                                                                                            ])
                                                                                                                                        @if (8 <= $lastLevelActive->id)
                                                                                                                                            @if (!empty($child6->children))
                                                                                                                                                <ul>
                                                                                                                                                    @foreach ($child6->children as $child7)
                                                                                                                                                        <li>
                                                                                                                                                            @include('genealogy.component.subniveles',
                                                                                                                                                                [
                                                                                                                                                                    'data' => $child7,
                                                                                                                                                                ])
                                                                                                                                                            @if (9 <= $lastLevelActive->id)
                                                                                                                                                                @if (!empty($child4->children))
                                                                                                                                                                    <ul>
                                                                                                                                                                        @foreach ($child7->children as $child8)
                                                                                                                                                                            <li>
                                                                                                                                                                                @include('genealogy.component.subniveles',
                                                                                                                                                                                    [
                                                                                                                                                                                        'data' => $child8,
                                                                                                                                                                                    ])
                                                                                                                                                                                @if (10 <= $lastLevelActive->id)
                                                                                                                                                                                    @if (!empty($child4->children))
                                                                                                                                                                                        <ul>
                                                                                                                                                                                            @foreach ($child8->children as $child9)
                                                                                                                                                                                                <li>
                                                                                                                                                                                                    @include('genealogy.component.subniveles',
                                                                                                                                                                                                        [
                                                                                                                                                                                                            'data' => $child9,
                                                                                                                                                                                                        ])
                                                                                                                                                                                                </li>
                                                                                                                                                                                            @endforeach
                                                                                                                                                                                        </ul>
                                                                                                                                                                                    @endif
                                                                                                                                                                                @endif
                                                                                                                                                                            </li>
                                                                                                                                                                        @endforeach
                                                                                                                                                                    </ul>
                                                                                                                                                                @endif
                                                                                                                                                            @endif
                                                                                                                                                        </li>
                                                                                                                                                    @endforeach
                                                                                                                                                </ul>
                                                                                                                                            @endif
                                                                                                                                        @endif
                                                                                                                                    </li>
                                                                                                                                @endforeach
                                                                                                                            </ul>
                                                                                                                        @endif
                                                                                                                    @endif
                                                                                                                </li>
                                                                                                            @endforeach
                                                                                                        </ul>
                                                                                                    @endif
                                                                                                @endif
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </div>
                                                                            @endif
                                                                        @endif
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                    {{-- genera el lado binario izquierdo haciendo vacio --}}
                                                @endforeach
                                            </ul>
                                            {{-- fin nivel 3 --}}
                                        @endif
                                    </li>
                                    {{-- genera el lado binario izquierdo haciendo vacio --}}
                                @endforeach
                            </ul>
                            {{-- fin nivel 2 --}}
                        @endif
                    </li>
                    {{-- genera el lado binario izquierdo haciendo vacio --}}
                @endforeach
            </ul>
            {{-- fin nivel 1 --}}
        </li>
    </ul>
</div>
