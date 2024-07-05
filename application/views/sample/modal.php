<!DOCTYPE html>
<html>
<head>
  <title>Contoh Modal Bootstrap dengan Vue.js</title>
  <!-- Tautan ke Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
</head>
<body>
  <div id="app">
    <button @click="openModal" class="btn btn-primary">Buka Modal</button>

    <div class="modal" id="myModal">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <p><b>test</b>31231</p>
                                    
                                </div>
                                <br>
                                <div>
                                    sdsadas
                                </div>
                            </div>
                        </div>
                    </div>
		</div>


    <!-- Modal -->
    <div class="modal" tabindex="-1" role="dialog" v-if="showModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Contoh Modal</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="closeModal"></button>
          </div>
          <div class="modal-body">
            <p>Ini adalah konten modal.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="closeModal">Tutup</button>
            <button type="button" class="btn btn-primary">Simpan Perubahan</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Tautan ke Vue.js dan Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://unpkg.com/vue@next"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>

  <script>
    const app = Vue.createApp({
      data() {
        return {
          showModal: false
        };
      },
      methods: {
        openModal() {
          this.showModal = true;
          $('#myModal').modal('show');
        },
        closeModal() {
          this.showModal = false;
        }
      }
    });

    app.mount('#app');
  </script>
</body>
</html>
