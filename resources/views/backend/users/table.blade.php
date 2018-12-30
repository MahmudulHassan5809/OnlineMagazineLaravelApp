 <table class="table table-hover">
                     <thead>
                       <tr>
                         <th>Action</th>
                         <th>User Name</th>
                         <th>Email</th>
                         <th>Role</th>
                       </tr>
                     </thead>
                     <tbody>
                      @foreach ($users as $user)
                        <tr>
                         <td>

                           <a class="btn btn-xs btn-default" href="{{ route('users.edit',$user->id) }}">
                             <i class="fa fa-edit"></i>
                           </a>
                           @if ($user->id == config('cms.default_user_id') || $user->id == Auth::user()->id)
                               <button onclick="return false" type="submit" class="disabled btn btn-xs btn-danger">
                               <i class="fa fa-times"></i>
                              </button>
                           @else
                             <a href="{{ route('backend.users.confirm', $user->id) }}" onclick="return confirm('Are You Sure');" type="submit" class="btn btn-xs btn-danger">
                               <i class="fa fa-times"></i>
                              </a>
                           @endif


                         </td>
                         <td>{{ $user->name }}</td>
                         <td>{{ $user->email }}</td>
                         <td>
                          @if($user->roles->first())
                            {{ $user->roles->first()->display_name }}
                          @endif
                        </td>

                       </tr>
                      @endforeach
                     </tbody>
                   </table>
