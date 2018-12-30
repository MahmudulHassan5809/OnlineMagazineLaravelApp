@section('style')
    <link rel="stylesheet" href="/backend/plugins/tag-editor/jquery.tag-editor.css">
@endsection

@section('script')
  <script src="/backend/plugins/tag-editor/jquery.caret.min.js"></script>
    <script src="/backend/plugins/tag-editor/jquery.tag-editor.min.js"></script>
  <script type="text/javascript">
        var options = {};

    @if($post->exists)
        options = {
            initialTags: {!! json_encode($post->tags->pluck('name')) !!},
        };
    @endif

    $('input[name=post_tags]').tagEditor(options);
  </script>
  <script>
    $('#title').on('blur',function(){
      var title = this.value.toLowerCase().trim(),
          slugInput = $('#slug'),
          slug = title.replace(/&/g,'-and-')
                      .replace(/[^a-z0-9-]+/g,'-')
                      .replace(/\-\-+/g,'-')
                      .replace(/^-+|-+$/g,'');

      slugInput.val(slug);
    });
  </script>
  <script>
      var simplemde1 = new SimpleMDE({ element: $("#excerpt")[0] });
      var simplemde2 = new SimpleMDE({ element: $("#body")[0] });
  </script>

  <script type="text/javascript">
    $('#draft-btn').click(function(e){
      e.preventDefault();
      $('#published_at').val("");
      $('#post-form').submit();
    });
  </script>
@endsection
