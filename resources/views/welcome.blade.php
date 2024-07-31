<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tp  Blog simple</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">

  </head>
  <body>
    <h1 class="justify-center text-center align-items-center p-3">Bienvenue sur mon blog!</h1>
    
    <div class="container">
      <div class="row p-4">
        <h4>Gestion Posts</h4>
        <!-- Button créer post  -->
        <button type="button" class="btn btn-primary w-25" data-bs-toggle="modal" data-bs-target="#postmodal">
          Créer un post
        </button>

        <!-- Créer post -->
        <div class="modal fade" id="postmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Création de Post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="{{ route('addPost') }}" method="POST">
                  @csrf
                  @method('POST')
                  <div class="mb-3">
                      <label for="Nom" class="form-label">Titre</label>
                      <input type="text" name="title" class="form-control" id="Nom" aria-describedby="NomHelp" required>
                      @error('title')
                          <div id="NomHelp" class="form-text" style="color:red;">Champ obligatoire</div>
                      @enderror
                  </div>
          
                  <div class="mb-3">
                      <label for="membres" class="form-label">Contenu</label>
                      <textarea class="form-control" name="content" id="" cols="30" rows="10" required></textarea>
                      @error('content')
                          <div id="membresHelp" class="form-text" style="color:red;">Champ obligatoire</div>
                      @enderror
                  </div>
          
                  <button type="submit" class="btn btn-primary">Sauvegarder</button>
                  @if(session('success'))
                  <script>
                      swal({
                          title: "Succès!",
                          text: "opération effectuée avec succès",
                          icon: "success",
                          button: "OK",
                          });
                  </script>
                @elseif (session('error'))
                    <script>
                        swal({
                            title: "Echec!",
                            text: "Echec de l'opération",
                            icon: "error",
                            button: "OK",
                            });
                    </script>
                @endif
              </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
              </div>
            </div>
          </div>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Titre</th>
              <th scope="col">Contenu</th>
              <th scope="col">Date de publication</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($posts as $post)
            <tr>
              <td>{{$post->title}}</td>
              <td>{{$post->content}}</td>
              <td>{{$post->created_at}}</td>
              <td>
                <button class="icon-button1" title="View">
                  <a href="{{url('post/welcomeDetail/'.$post->id)}}" style="color: #2872a7;"><i class="fa fa-eye"></i></a>
                </button>
                <button class="icon-button1" title="update" data-bs-toggle="modal" data-bs-target="#postmodal{{$post->id}}">
                  <a href="#" style="color: #0f9b53;"><i class="fa fa-edit"></i></a>
                </button>
                <button class="icon-button1" title="delete" data-bs-toggle="modal" data-bs-target="#deletepostmodal{{$post->id}}">
                  <a href="#" style="color: #ba1313;"><i class="fa fa-trash"></i></a>
                </button>
                <button class="icon-button1" title="comment" data-bs-toggle="modal" data-bs-target="#commentpostmodal{{$post->id}}">
                  <a href="#" style="color: #3f13ba;"><i class="fa fa-book"></i></a>
                </button>
              </td>
            </tr>
              <!-- Update post -->
              <div class="modal fade" id="postmodal{{$post->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Modification du Post</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('updatePost', ['id' => $post->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="Nom" class="form-label">Titre</label>
                            <input type="text" value="{{$post->title}}" name="title" class="form-control" id="Nom" aria-describedby="NomHelp" required>
                            @error('title')
                                <div id="NomHelp" class="form-text" style="color:red;">Champ obligatoire</div>
                            @enderror
                        </div>
                
                        <div class="mb-3">
                            <label for="Contenu" class="form-label">Contenu</label>
                            <textarea class="form-control" name="content" id="" cols="30" rows="10" required>{{$post->content}}</textarea>
                            @error('content')
                                <div id="membresHelp" class="form-text" style="color:red;">Champ obligatoire</div>
                            @enderror
                        </div>
                
                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                        @if(session('success'))
                        <script>
                            swal({
                                title: "Succès!",
                                text: "opération effectuée avec succès",
                                icon: "success",
                                button: "OK",
                                });
                        </script>
                      @elseif (session('error'))
                          <script>
                              swal({
                                  title: "Echec!",
                                  text: "Echec de l'opération",
                                  icon: "error",
                                  button: "OK",
                                  });
                          </script>
                      @endif
                    </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- delete post -->
              <div class="modal fade" id="deletepostmodal{{$post->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Suppression du Post</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('deletePost', ['id' => $post->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="mb-3">
                            <label for="Nom" class="form-label">Voulez-vous supprimer?</label>
                            <input type="text" value="{{$post->id}}" name="id" hidden>
                        </div>
                
                        <button type="submit" class="btn btn-primary">Supprimer</button>
                        @if(session('success'))
                        <script>
                            swal({
                                title: "Succès!",
                                text: "opération effectuée avec succès",
                                icon: "success",
                                button: "OK",
                                });
                        </script>
                      @elseif (session('error'))
                          <script>
                              swal({
                                  title: "Echec!",
                                  text: "Echec de l'opération",
                                  icon: "error",
                                  button: "OK",
                                  });
                          </script>
                      @endif
                    </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Add Comment -->
              <div class="modal fade" id="commentpostmodal{{$post->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Commentaire du Post</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('addComment')}}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <div class="mb-3">
                            <label for="Nom" class="form-label">Nom de l'auteur</label>
                            <input type="text" name="author_name" class="form-control" id="Nom" aria-describedby="NomHelp" required>
                            @error('title')
                                <div id="NomHelp" class="form-text" style="color:red;">Champ obligatoire</div>
                            @enderror
                        </div>
                
                        <div class="mb-3">
                            <label for="Contenu" class="form-label">Contenu</label>
                            <textarea class="form-control" name="content" id="" cols="30" rows="10" required></textarea>
                            @error('content')
                                <div id="membresHelp" class="form-text" style="color:red;">Champ obligatoire</div>
                            @enderror
                        </div>
                
                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                        @if(session('success'))
                        <script>
                            swal({
                                title: "Succès!",
                                text: "opération effectuée avec succès",
                                icon: "success",
                                button: "OK",
                                });
                        </script>
                      @elseif (session('error'))
                          <script>
                              swal({
                                  title: "Echec!",
                                  text: "Echec de l'opération",
                                  icon: "error",
                                  button: "OK",
                                  });
                          </script>
                      @endif
                    </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="row p-4">
        <h4>Gestion Commentaires</h4>
        
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Nom de l'auteur</th>
              <th scope="col">Contenu</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($comments as $comment)
            <tr>
              <td>{{$comment->author_name}}</td>
              <td>{{$comment->content}}</td>
              <td>{{$comment->created_at}}</td>
              <td>
                <button class="icon-button1" title="update" data-bs-toggle="modal" data-bs-target="#updatecommentmodal{{$comment->id}}">
                  <a href="#" style="color: #0f9b53;"><i class="fa fa-edit"></i></a>
                </button>
                <button class="icon-button1" title="delete" data-bs-toggle="modal" data-bs-target="#deletecommentmodal{{$comment->id}}">
                  <a href="#" style="color: #ba1313;"><i class="fa fa-trash"></i></a>
                </button>
              </td>
            </tr>
              <!-- Update post -->
              <div class="modal fade" id="updatecommentmodal{{$comment->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Modification du commentaire</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('updateComment', ['id' => $comment->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="Nom" class="form-label">Nom de l'auteur</label>
                            <input type="hidden" name="post_id" value="{{$comment->post_id}}">
                            <input type="text" value="{{$comment->author_name}}" name="author_name" class="form-control" id="Nom" aria-describedby="NomHelp" required>
                            @error('author_name')
                                <div id="NomHelp" class="form-text" style="color:red;">Champ obligatoire</div>
                            @enderror
                        </div>
                
                        <div class="mb-3">
                            <label for="Contenu" class="form-label">Contenu</label>
                            <textarea class="form-control" name="content" id="" cols="30" rows="10" required>{{$comment->content}}</textarea>
                            @error('content')
                                <div id="membresHelp" class="form-text" style="color:red;">Champ obligatoire</div>
                            @enderror
                        </div>
                
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        @if(session('success'))
                        <script>
                            swal({
                                title: "Succès!",
                                text: "opération effectuée avec succès",
                                icon: "success",
                                button: "OK",
                                });
                        </script>
                      @elseif (session('error'))
                          <script>
                              swal({
                                  title: "Echec!",
                                  text: "Echec de l'opération",
                                  icon: "error",
                                  button: "OK",
                                  });
                          </script>
                      @endif
                    </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- delete post -->
              <div class="modal fade" id="deletecommentmodal{{$comment->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Suppression du Commentaire</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('deleteComment', ['id' => $comment->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="mb-3">
                            <label for="Nom" class="form-label">Voulez-vous supprimer?</label>
                            <input type="text" value="{{$comment->id}}" name="id" hidden>
                        </div>
                
                        <button type="submit" class="btn btn-primary">Supprimer</button>
                        @if(session('success'))
                        <script>
                            swal({
                                title: "Succès!",
                                text: "opération effectuée avec succès",
                                icon: "success",
                                button: "OK",
                                });
                        </script>
                      @elseif (session('error'))
                          <script>
                              swal({
                                  title: "Echec!",
                                  text: "Echec de l'opération",
                                  icon: "error",
                                  button: "OK",
                                  });
                          </script>
                      @endif
                    </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>   
  </body>
</html>