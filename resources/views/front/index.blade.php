@extends('front.layout')

@section('hero')

    @isset($heros)

    <style>
        a:hover{
            color: rgb(236, 236, 236)
        }
        #hero_main{
            height: 100%;
            text-shadow: 1px 1px 2px black;
            background-color: rgb(48, 48, 48);
        }
        .link-hero {
            color: white;
        }
        #hero_main > div{
            background-position: center;
            background-size:cover;
            border-radius: 40px;
            background-repeat: no-repeat;
            box-shadow: rgb(43, 43, 43) 8px 5px 5px ;
            overflow: hidden;

        }
        .image{
            position: absolute;
            background-position: center;
            background-size:cover;
            background-repeat: no-repeat;
            height: 100%;
            width: 100%;
            border-radius: 40px;
            transition: 0.4s;
        }
        .image > a{
            height: 100%;
            width: 100%;
   	}
        .resume{
            position: absolute;
            display: none;
            top: 20%;
            left: 50%;
            transform: translate(-50%,-50%);
            color:white;
        }
        #hero_main > div:hover  .resume  {
            display: block;
        }
        #hero_main > div:hover{
            box-shadow: black 8px 5px 5px ;
        }
        #hero_main > div:hover .image{

            filter: blur(15px);

        }
        #hero_main > div:nth-of-type(1){
            position: absolute;
            height: 57%;
            width: 68%;
            left: 1%;
            bottom: 32%
        }
        #hero_main > div:nth-of-type(2){
            position: absolute;
            height: 27%;
            width: 68%;
            left:1%;
            bottom: 2%
        }
        #hero_main > div:nth-of-type(3){
            position: absolute;
            height: 27%;
            width: 28%;
            right:1%;
            bottom: 62%
        }
        #hero_main > div:nth-of-type(4){
            position: absolute;
            height: 27%;
            width: 28%;
            right:1%;
            bottom:32%;
        }
        #hero_main > div:nth-of-type(5){
            position: absolute;
            height: 27%;
            width: 28%;
            right:1%;
            bottom: 2%;
        }
        .entry__thumb{
            border-radius: 20px;
        }
        .nom{
            position: absolute;
            bottom: 0;
            left: 15px;
	}
	#hero_main > div > div > h1{
	background:rgba(0,0,0,0.7);
            border-radius: 10px;
	}

        .byline-hero{
            margin-left: 110px;
            color: rgb(255, 255, 255);
            text-shadow: 1px 1px 2px rgb(0, 0, 0);
        }
        @media screen and (max-width: 700px) {
            #hero_main > div{
                border-radius: 0;
            }
            .image{
                border-radius: 0;
            }
	    .nom{
	    	left:0;
		bottom:0;
		
	    }
	    h1{
	   	 border-radius: 0px;
		margin-bottom:0;

	    }
	    .entry__meta{
		display:none;
	    }
            #hero_main > div:nth-of-type(1){
                position: absolute;
                height: 53%;
                width: 98%;
                left: 1%;
                bottom: 45%
            }
            #hero_main > div:nth-of-type(2){
                position: absolute;
                height: 21%;
                width: 98%;
                left: 1%;
                bottom: 23%
            }
            #hero_main > div:nth-of-type(3){
                position: absolute;
                height: 21%;
                width: 98%;
                left: 1%;
                bottom: 1%
            }
            #hero_main > div:nth-of-type(4){display:none;}
            #hero_main > div:nth-of-type(5){display:none;}

        }

    </style>


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
