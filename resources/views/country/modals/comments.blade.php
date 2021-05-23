<div class="modal-content" xmlns="http://www.w3.org/1999/html">

        <div class="modal-header">

            <p><b>Comments</b></p>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        </div>

        <div class="modal-body">

            <form action="{{ route('country.comment.store')  }}" method="POST" id="addPartnerPage">
                @csrf

                <i>Write a comment</i>
                <input name='userId' type="hidden" value="{{ auth()->user()->id }}">
                <input name='countryCode' type="hidden" value="{{ $countryCode }}">
                <textarea required style="margin: 5px 0 5px 0" name="comment" class="form-control"> </textarea>
                <button type="submit" class="btn btn-primary">Send</button>

            </form><br>

            <p><b>All comments</b></p><hr>

            @foreach($comments as $comment)

                <div class="comments_box">

                    <p>{{$comment->comment}}</p>
                    <small><i>Created: {{$comment->created_at}}</i></small>

                </div><hr>

            @endforeach

            <div class="form-group pages" id="contentsModal" >

            </div>

        </div>


        <div class="modal-footer">

            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        </div>

    </div>




