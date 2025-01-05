@extends('layouts.feat')

@section('content')
<!-- Bar Loading Overlay -->
<div id="loadingBar" class="loading-bar d-none position-fixed top-0 start-0 w-0 bg-primary" style="height: 5px;"></div>

<!-- Licenses Section -->
<section id="licenses" style="text-align: center;">
    <h2 style="font-size: 36px; font-weight: bold; margin-bottom: 20px; color: #ff8c00;">Licenses for DKIS</h2>
    <p style="font-size: 18px; line-height: 1.6; color: light; margin-bottom: 40px;">
        At <strong>DKIS</strong>, we Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsam assumenda delectus voluptatum repellat debitis recusandae tempore eos, a nam omnis. Beatae iusto expedita, blanditiis repellat veniam nesciunt quae aperiam odit.. 
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolor, labore quasi quia animi ea deserunt minus sint facere eos nulla pariatur possimus commodi aliquid minima. Error vitae consectetur non unde..
    </p>

    <!-- License Information -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; padding: 10px;">
        <div style="background-color: #39394d; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <i class="fas fa-cogs" style="font-size: 50px; color: #ff8c00; margin-bottom: 20px;"></i>
            <h3 style="font-size: 24px; font-weight: bold; color: #fff;">MagangMagang</h3>
            <p style="font-size: 16px; color: #ccc;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Error quibusdam aliquam natus voluptatibus deleniti minima eaque id dolores esse labore. Error nemo porro corrupti provident exercitationem iure laudantium laboriosam. Laborum!</p>
        </div>
        <div style="background-color: #39394d; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <i class="fas fa-user-shield" style="font-size: 50px; color: #ff8c00; margin-bottom: 20px;"></i>
            <h3 style="font-size: 24px; font-weight: bold; color: #fff;">MagangMagangMagang</h3>
            <p style="font-size: 16px; color: #ccc;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sint itaque maiores commodi vel, illum maxime officia placeat labore adipisci quisquam odio dolore, cum obcaecati ea mollitia! In inventore est dicta.</p>
        </div>
        <div style="background-color: #39394d; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <i class="fas fa-file-contract" style="font-size: 50px; color: #ff8c00; margin-bottom: 20px;"></i>
            <h3 style="font-size: 24px; font-weight: bold; color: #fff;">MagangMagang</h3>
            <p style="font-size: 16px; color: #ccc;">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Suscipit doloribus quod voluptatum non laboriosam quae nesciunt nihil iusto optio impedit dicta tempora pariatur, expedita, itaque unde repellat distinctio nobis sit?.</p>
        </div>
        <div style="background-color: #39394d; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <i class="fas fa-info-circle" style="font-size: 50px; color: #ff8c00; margin-bottom: 20px;"></i>
            <h3 style="font-size: 24px; font-weight: bold; color: #fff;">MagangMagangMagang</h3>
            <p style="font-size: 16px; color: #ccc;">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Hic, sequi velit voluptatibus aperiam earum dolor voluptas ipsum esse sapiente eligendi maxime harum ut quam, nesciunt nemo porro aut fugit inventore..</p>
        </div>
    </div>

</section>


@push('scripts')
<script>
    //Untuk Loading bar
    const loadingBar = document.getElementById('loadingBar');

    function showLoadingBar() {
        loadingBar.classList.remove('d-none');
        loadingBar.style.width = '0%';
        setTimeout(() => {
            loadingBar.style.transition = 'width 2s ease-in-out';
            loadingBar.style.width = '100%';
        }, 10); // Delay untuk memulai animasi setelah elemen ditampilkan
    }

    function hideLoadingBar() {
        setTimeout(() => {
            loadingBar.style.transition = 'width 0.5s ease-in-out';
            loadingBar.style.width = '0%';
            setTimeout(() => {
                loadingBar.classList.add('d-none');
            }, 500); // Tunggu sampai animasi selesai sebelum menyembunyikan elemen
        }, 2000); // Durasi penuh loading sebelum disembunyikan
    }

    // Contoh penggunaan:
    document.addEventListener('DOMContentLoaded', () => {
        // Tampilkan loading bar ketika memulai halaman
        showLoadingBar();

        // Sembunyikan loading bar setelah 2 detik
        hideLoadingBar();
    });
</script>
@endpush

@endsection
