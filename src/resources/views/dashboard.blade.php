<x-app-layout>
    <div class="mx-auto container pt-12 flex flex-row justify-between items-center">
      <div class='text-2xl text-gray-800'>みんなの推し一覧</div>
      @if(Auth::check())
        <div class="p-2">
          <a href="{{ route('posts.create') }}" class="btn flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">推し登録へ</a>
        </div>
      @endif
    </div>

    <section class="text-gray-600 body-font">
      <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-wrap -m-4">
          @foreach($posts as $post)
            <div class="p-4 md:w-1/3">
              <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="/storage/images/{{ $post->image_path }}" alt="blog">
                <div class="p-6">
                  <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">推しタイトル</h2>
                  <h1 class="title-font text-lg font-medium text-gray-900 mb-3"> {{ $post->title }} </h1>
                  <p class="leading-relaxed mb-3"> {{ $post->comment }} </p>
                  <div class="flex items-center flex-wrap ">
                    <span class="text-gray-400 mr-3 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-sm pr-3 py-1">
                      <div class='btn-group'>
                        @if ($isAuthenticated && $post->isNotPostOwner)
                            @if ($post->isLiked)
                                {!! Form::open(['route' => ['likes.unlike', $post->id], 'method' => 'delete']) !!}
                                    {!! Form::submit('いいねを外す', ['class' => "btn btn-danger btn-sm"]) !!}
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(['route' => ['likes.like', $post->id]]) !!}
                                    {!! Form::submit('いいね！', ['class' => "btn btn-primary btn-sm"]) !!}
                                {!! Form::close() !!}
                            @endif
                        @endif
                      </div>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
</x-app-layout>
