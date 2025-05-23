

@foreach($product->comments as $comment)
    <div class="media border p-3 mb-3">
        <img onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'" src="{{ asset('storage/app/public/profile/' . ($comment->user->image ?? 'default.png')) }}" alt="{{ $comment->user->name ?? 'Guest' }}" class="mr-3 mt-3 rounded-circle" style="width:45px;">
        <div class="media-body">
            <h5>{{ $comment->user ? $comment->user->f_name . ' ' . $comment->user->l_name : 'Guest' }} <small><i>{{ $comment->created_at->locale('ar')->diffForHumans()}}</i></small></h5>
            <p>{{ $comment->comment }}</p>
            <div>
                <button class="btn btn-link reply-btn" data-comment-id="{{ $comment->id }}">{{ translate('Reply') }}</button>
<button class="btn btn-link like-btn {{ $comment->likes->where('customer_id', Auth::id())->count() > 0 ? 'liked' : '' }}" data-comment-id="{{ $comment->id }}">
    {{ $comment->likes->where('customer_id', Auth::id())->count() > 0 ? translate('Unlike') : translate('Like') }}
</button>

                <span>{{ $comment->likes->count() }}</span>
                   @if(Auth::id() == $comment->user_id)
                    <button class="btn btn-link delete-comment-btn" data-comment-id="{{ $comment->id }}">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                @endif
            </div>
            @foreach($comment->replies as $reply)
                <div class="media p-3">
                    <img onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'" src="{{ asset('path/to/default/avatar.png') }}" alt="{{ $reply->user->name ?? 'Guest' }}" class="mr-3 mt-3 rounded-circle" style="width:45px;">
                    <div class="media-body">
                        <h5>{{ $reply->user ? $comment->user->f_name . ' ' . $comment->user->l_name : 'Guest' }}<small><i>{{ $reply->created_at->locale('ar')->diffForHumans() }}</i></small></h5>
                        <p>{{ $reply->comment }}</p>
                           @if(Auth::id() == $reply->user_id)
                            <button class="btn btn-link delete-reply-btn" data-reply-id="{{ $reply->id }}">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endforeach
