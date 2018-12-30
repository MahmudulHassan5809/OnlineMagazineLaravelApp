 <table class="table table-hover">
                     <thead>
                       <tr>
                         <th>Action</th>
                         <th>Category Name</th>
                         <th>Posts Count</th>

                       </tr>
                     </thead>
                     <tbody>
                      @foreach ($categories as $cat)
                        <tr>
                         <td>
                          {!! Form::open(['method' => 'DELETE','route' => ['categories.destroy',$cat->id] ]) !!}
                           <a class="btn btn-xs btn-default" href="{{ route('categories.edit',$cat->id) }}">
                             <i class="fa fa-edit"></i>
                           </a>
                           @if ($cat->id == config('cms.default_category_id'))
                               <button onclick="return false" type="submit" class="disabled btn btn-xs btn-danger">
                               <i class="fa fa-times"></i>
                              </button>
                           @else
                             <button onclick="return confirm('Are You Sure');" type="submit" class="btn btn-xs btn-danger">
                               <i class="fa fa-times"></i>
                              </button>
                           @endif

                           {!! Form::close() !!}
                         </td>
                         <td>{{ $cat->title }}</td>
                         <td>{{ $cat->posts()->count() }}</td>


                       </tr>
                      @endforeach
                     </tbody>
                   </table>
