@props(['listing'])
<x-card>
    <div class="flex">
        <img
            class="hidden w-48 mr-6 md:block"
            src="{{$listing->logo ? asset('storage/' . $listing->logo) : asset('images/no-image.png')}}"

            alt=""
        />
        <div>
            <h3 class="text-2xl">
                <a href="/listings/{{$listing->id}}">{{$listing->title}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{$listing->company}}</div>
           <x-listing-tags :tagsCsv="$listing->tags"/>
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i> Boston,
                MA
            </div>
            @auth
            @if(auth()->id() == $listing->user_id)
            <x-card class="mt-4 flex justify-between">
                <a title="{{$listing->title}}" href="/listings/{{$listing->id}}/edit"><i class="fa-solid fa-pencil"> </i> Edit</a>
                <form action="/listings/{{$listing->id}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-400 text-white hover:bg-red-200"><i class="fa-solid fa-trash"></i> Delete</button>
            </form>
            </x-card>
            @endif
            @endauth

        </div>
    </div>
</x-card>
