<x-layout>
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px;">
        <div style="background: linear-gradient(135deg, #f0f4ff 0%, #ffffff 100%); padding: 24px; border: 1px solid #e0e7ff; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <p style="color: #666; font-size: 12px; margin: 0 0 12px 0; text-transform: uppercase; letter-spacing: 0.5px;">Total Peminjaman</p>
            <p style="font-size: 36px; font-weight: 700; margin: 0; color: #1e293b;">{{ $peminjamans->count() }}</p>
        </div>

        <div style="background: linear-gradient(135deg, #fffbf0 0%, #ffffff 100%); padding: 24px; border: 1px solid #ffe4b5; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <p style="color: #666; font-size: 12px; margin: 0 0 12px 0; text-transform: uppercase; letter-spacing: 0.5px;">Menunggu</p>
            <p style="font-size: 36px; font-weight: 700; margin: 0; color: #f59e0b;">{{ $peminjamans->where('status', 'menunggu')->count() }}</p>
        </div>

        <div style="background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%); padding: 24px; border: 1px solid #bbf7d0; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <p style="color: #666; font-size: 12px; margin: 0 0 12px 0; text-transform: uppercase; letter-spacing: 0.5px;">Disetujui</p>
            <p style="font-size: 36px; font-weight: 700; margin: 0; color: #22c55e;">{{ $peminjamans->where('status', 'disetujui')->count() }}</p>
        </div>

        <div style="background: linear-gradient(135deg, #fef2f2 0%, #ffffff 100%); padding: 24px; border: 1px solid #fecaca; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <p style="color: #666; font-size: 12px; margin: 0 0 12px 0; text-transform: uppercase; letter-spacing: 0.5px;">Ditolak</p>
            <p style="font-size: 36px; font-weight: 700; margin: 0; color: #ef4444;">{{ $peminjamans->where('status', 'ditolak')->count() }}</p>
        </div>
    </div>

    <div style="background: white; border: 1px solid #e5e7eb; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); overflow: hidden;">
        <div style="padding: 24px; border-bottom: 1px solid #e5e7eb; background: #f9fafb;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                <h2 style="margin: 0; font-size: 20px; font-weight: 700; color: #1e293b;">Daftar Peminjaman</h2>
                @if($user->role === 'user')
                    <a href="/peminjaman/create" style="background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%); color: white; padding: 12px 24px; text-decoration: none; border-radius: 8px; font-size: 14px; font-weight: 600; box-shadow: 0 2px 4px rgba(34, 197, 94, 0.2); transition: all 0.3s ease;">+ Buat Pengajuan</a>
                @endif
            </div>
            
            <form action="/peminjaman" method="GET" style="display: flex; gap: 10px; margin: 0;">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari peminjam atau barang..." style="flex: 1; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; background: white; transition: all 0.3s ease;">
                <button type="submit" style="padding: 10px 14px; border: 1px solid #d1d5db; background: white; border-radius: 8px; cursor: pointer; transition: all 0.3s ease; color: #333; font-weight: 500;">Cari</button>
                @if(request('search'))
                    <a href="/peminjaman" style="padding: 10px 14px; border: 1px solid #ddd; background: #e5e7eb; color: #4b5563; border-radius: 8px; text-decoration: none; font-size: 14px; display: inline-block; font-weight: 500;">Reset</a>
                @endif
            </form>
        </div>

        <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
            <thead>
                <tr style="background: #f3f4f6; border-bottom: 2px solid #e5e7eb;">
                    <th style="padding: 14px; text-align: left; font-weight: 600; color: #374151;">Peminjam</th>
                    <th style="padding: 14px; text-align: left; font-weight: 600; color: #374151;">Nama Barang</th>
                    <th style="padding: 14px; text-align: left; font-weight: 600; color: #374151;">Tanggal Pinjam</th>
                    <th style="padding: 14px; text-align: left; font-weight: 600; color: #374151;">Tanggal Kembali</th>
                    <th style="padding: 14px; text-align: left; font-weight: 600; color: #374151;">Keperluan</th>
                    <th style="padding: 14px; text-align: left; font-weight: 600; color: #374151;">Status</th>
                    @if($user->role === 'admin')
                        <th style="padding: 14px; text-align: left; font-weight: 600; color: #374151;">Aksi Admin</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($peminjamans as $p)
                <tr style="border-bottom: 1px solid #e5e7eb; transition: all 0.2s ease;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='white'">
                    <td style="padding: 14px; color: #1f2937; font-weight: 500;">{{ $p->user->name ?? 'User' }}</td>
                    <td style="padding: 14px; color: #4b5563;">{{ $p->barang->nama ?? 'Barang Terhapus' }}</td>
                    <td style="padding: 14px; color: #4b5563;">{{ $p->tgl_pinjam }}</td>
                    <td style="padding: 14px; color: #4b5563;">{{ $p->tgl_kembali_rencana }}</td>
                    <td style="padding: 14px; color: #4b5563;">{{ $p->catatan ?? '-' }}</td>
                    <td style="padding: 14px;">
                        @if($p->status === 'disetujui' || $p->status === 'dikembalikan')
                            <span style="background: #dcfce7; color: #166534; padding: 6px 14px; border-radius: 6px; font-size: 12px; font-weight: 600; display: inline-block;">{{ $p->status }}</span>
                        @elseif($p->status === 'ditolak')
                            <span style="background: #fee2e2; color: #991b1b; padding: 6px 14px; border-radius: 6px; font-size: 12px; font-weight: 600; display: inline-block;">{{ $p->status }}</span>
                        @else
                            <span style="background: #fef3c7; color: #92400e; padding: 6px 14px; border-radius: 6px; font-size: 12px; font-weight: 600; display: inline-block;">{{ $p->status }}</span>
                        @endif
                    </td>
                    @if($user->role === 'admin')
                        <td style="padding: 14px;">
                            <form action="/peminjaman/{{ $p->id }}/status" method="POST" style="display: inline;">
                                @csrf
                                <select name="status" onchange="this.form.submit()" style="padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; background: white; font-size: 13px; cursor: pointer; transition: all 0.2s ease; color: #374151;">
                                    <option value="menunggu" {{ $p->status === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="disetujui" {{ $p->status === 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                    <option value="ditolak" {{ $p->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    <option value="dikembalikan" {{ $p->status === 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                                </select>
                            </form>
                        </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>