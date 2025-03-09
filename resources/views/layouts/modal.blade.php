                                        <!-- Modal -->
                                        <div class="modal fade" id="ModalEditar{{ $item['_id']['$oid'] }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                            {{ $item['name'] }}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class=" row d-flex justify-content-center">
                                                            <div class=" col-9">
                                                                <label for="id" class=" form-label">ID</label>
                                                                <input type="text" name="id" id=""
                                                                    value="{{ $item['_id']['$oid'] }}"
                                                                    class=" form-control">
                                                            </div>
                                                            <div class=" col-9">
                                                                <label for="nombre" class=" form-label">Nombre</label>
                                                                <input type="text" name="nombre" id=""
                                                                    value="{{ $item['name'] }}" class=" form-control">
                                                            </div>
                                                            <div class=" col-9" class=" form-label">
                                                                <label for="price">Precio</label>
                                                                <input type="text" name="price" id=""
                                                                    value="{{ $item['price'] }}" class=" form-control">
                                                            </div>
                                                            <div class=" col-9" class=" form-label">
                                                                <label for="category">Categoria</label>
                                                                <input type="text" name="category" id=""
                                                                    value="{{ $item['category'] }}"
                                                                    class=" form-control">
                                                            </div>
                                                            <div class=" col-9" class=" form-label">
                                                                <label for="quantity">Cantidad</label>
                                                                <input type="text" name="quantity" id=""
                                                                    value="{{ $item['quantity'] }}"
                                                                    class=" form-control">
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
