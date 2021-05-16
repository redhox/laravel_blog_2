@extends('front.layout')

@section('hero')

    @isset($heros)

    


    <div id="hero_main">



        @foreach($heros as $hero)

        <a href="{{ route('posts.display', $hero->slug) }}">
        <div>
            <div class="image" style="background-image: url('storage/photos/{{ $hero->user->id }}/{{ $hero->image }}'); "></div>
            <div class="entry__excerpt resume"><p  >{{ $hero->excerpt }}</p></div>
            <div class="entry__header nom" style="z-index: 2">
                <h1 class="entry__title"><a class="link-hero"  href="{{ route('posts.display', $hero->slug) }}">{{ $hero->title }}</a></h1>
               <!--  <div class="entry__meta">
                    <span class="byline byline-hero"">@lang('By:')
                        <span class='author'>
                            <a class="link-hero" href="{{ route('author', $hero->user->id) }}">{{ $hero->user->name }}</a>
                        </span>
                    </span>
                </div> -->
            </div>
            <!--
            <div class="entry__excerpt"><p>{{ $hero->excerpt }}</p></div>
            -->

        </div>
        </a>


        @endforeach

    </div>

          <!-- resau soci
          <div class="s-hero__social hide-on-mobile-small">
              <p>@lang('Follow')</p>
              <span></span>
              <ul class="s-hero__social-icons">
                @foreach($follows as $follow)
                    <li>
                        <a href="{{ $follow->href }}">
                            <i
                                class="fab fa-{{ $follow->title === 'Facebook' ? 'facebook-f' : lcfirst($follow->title) }}"
                                aria-hidden="true">
                            </i>
                        </a>
                    </li>
                @endforeach
              </ul>
          </div>
        -->

    @endisset

@endsection

@section('main')

    @isset($title)
        <div class="row">
            <div class="column">
                <h1>{!! $title !!}</h1>
            </div>
        </div>
    @endisset

    <div class="s-bricks">

      <div class="masonry">
          <div class="bricks-wrapper h-group">

              <div class="grid-sizer"></div>

              <div class="lines">
                  <span></span>
                  <span></span>
                  <span></span>
              </div>

              @foreach($posts as $post)

                  <x-front.brick :post="$post" />

              @endforeach

            </div>

      </div>

      <div class="row">
          <div class="column large-12">
              {{ $posts->links('front.pagination') }}
          </div>
      </div>

  </div>

@endsection
