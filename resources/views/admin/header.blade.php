<div class="header ps-4 " 
style="
    border-radius: 10px;
    margin-bottom: 20px;
    display: flex;
    justify-content:space-between;
    align-items: center;
    width: 100%;
    
">
    <h2 class="mb-0">{{$title ?? '-'}}</h2>
    <div class="ms-3 " >
        <button class="btn btn-outline-danger" type="button"  data-bs-toggle="modal" data-bs-target="#logout">
            <i class="fas fa-sign-out-alt"></i> Logout
        </button>

        <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Logout</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('logout')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        Are you sure you want to logout of the system?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </div>

                </form>
                </div>
            </div>
        </div>
    </div>

</div>