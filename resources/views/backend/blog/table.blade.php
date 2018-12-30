 <table class="table table-hover">
                     <thead>
                       <tr>
                         <th>Action</th>
                         <th>Title</th>
                         <th>Author</th>
                         <th>Category</th>
                         <th>Date</th>
                       </tr>
                     </thead>
                     <tbody>
                      <?php $request = request(); ?>
                      @foreach ($posts as $post)
                        <tr>
                         <td>
                          {!! Form::open(['method' => 'DELETE','route' => ['blog.destroy',$post->id] ]) !!}
                          @if(check_user_permissions($request,"Blog@edit",$post->id))
                           <a class="btn btn-xs btn-default" href="{{ route('blog.edit',$post->id) }}">
                             <i class="fa fa-edit"></i>
                           </a>
                           @else
                            <a class="btn btn-xs btn-default disabled"  href="#">
                             <i class="fa fa-edit"></i>
                           </a>
                           @endif
                          @if(check_user_permissions($request,"Blog@destroy",$post->id))
                          <button type="submit" class="btn btn-xs btn-danger">
                             <i class="fa fa-times"></i>
                           </button>
                          @else
                          <button type="button" onclick="return false" class="btn btn-xs btn-danger disabled">
                             <i class="fa fa-times"></i>
                           </button>
                          @endif
                           {!! Form::close() !!}
                         </td>
                         <td>{{ $post->title }}</td>
                         <td>{{ $post->user->name }}</td>
                         <td>{{ $post->category->title }}</td>
                         <td>
                          {{ $post->dateFormatted(true) }}
                          <span class="label label-success">{!! $post->publicationLabel()  !!}</span>
                        </td>
                       </tr>
                      @endforeach
                     </tbody>
                   </table>
