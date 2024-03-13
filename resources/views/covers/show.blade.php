<x-guest-layout>
  <div class="text-white container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ $cover->title }}</div>

          <div class="card-body">
            <p>
              <strong>Description:</strong>
              {{ $cover->description }}
            </p>
            <p>
              <strong>Image:</strong>
              <img src="{{ Storage::url($cover->img_key) }}" alt="{{ $cover->title }}" />
            </p>
            <p>
              <strong>Language:</strong>
              {{ $cover->lang_id }}
            </p>
            <p>
              <strong>Average Reading Time:</strong>
              {{ $cover->average_reading_time_sec }} seconds
            </p>
            <p>
              <strong>Word Count:</strong>
              {{ $cover->words_count }}
            </p>
            <p>
              <strong>Published At:</strong>
              {{ $cover->published_at }}
            </p>
            <p>
              <strong>Finished At:</strong>
              {{ $cover->finished_at }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>
