<div class="alert alert-info">
    <p class="center"><strong>Syarat Kelulusan {{ $title['singular'] or ''}}</strong></p>     
    <ul> 
		@if($title['singular'] == 'Engage')
	    	<li>Sesi 1-3 harus ikut</li>
	    	<li>Absen hanya 1 sesi tapi bukan sesi 1-3 dan bisa lanjut ke kelas establish.</li>
	    	<li>Hanya ikut 1-2 sesi maka harus ulang dari awal dianggap tdk lulus</li>
	    	<li>Hanya ikut 3-5 sesi blm lulus tapi bisa menyelesaikan yg blm saja</li>
		@elseif($title['singular'] == 'Establish')
			<li>Sudah selesai kelas Engage</li>
			<li>Absen hanya boleh 2 sesi dianggap lulus tapi harus menyelesaikan sisa sesi yang belum</li>
			<li>Hanya ikut 1-2 sesi maka harus ulang dari awal dianggap tdk lulus</li>
			<li>Hanya ikut 3-5 sesi blm lulus tapi bisa menyelesaikan yg blm saja-</li>
		@elseif($title['singular'] == 'Equip')
			<li>Sudah selesai kelas Establish</li>
			<li>Sesi 1 mandatory.. tdk ikut sesi 1, maka sesi selanjutnya tdk bisa lanjut...</li>
			<li>Absen hanya boleh 2 sesi tapi dianggap lulus tapi harus menyelesaikan yg belum</li>
			<li>Hanya ikut 1-2 sesi maka harus ulang dari awal dianggap tdk lulus</li>
			<li>Hanya ikut 3-5 sesi blm lulus tapi bisa menyelesaikan yg blm saja</li>
		@elseif($title['singular'] == 'Empower')
			<li>Minimal menyelesaikan sesi 1-3</li>
			<li>Telah menyelesaikan kelas equip</li>
		@endif
    </ul>
</div>


