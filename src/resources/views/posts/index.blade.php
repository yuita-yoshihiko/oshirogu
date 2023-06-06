<x-app-layout>
  <div class="mx-auto container pt-12 flex flex-row justify-between items-center">
    <div class='text-2xl text-gray-800'>自分の推し一覧</div>
      <div class="p-2">
        <a href="{{ route('posts.create') }}" class="btn flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">推し登録へ</a>
      </div>
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
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
</x-app-layout>