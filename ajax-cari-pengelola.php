<?php
include('koneksi.php');

$search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';

$sql = "SELECT * FROM tb_pengelola
        WHERE LOWER(nama) LIKE LOWER('%$search%')
           OR LOWER(no_ktp) LIKE LOWER('%$search%')
           OR LOWER(jabatan) LIKE LOWER('%$search%')
        ORDER BY id DESC
        LIMIT 50";

$result = $koneksi->query($sql);
$no = 1;

if ($result->num_rows > 0) {
    while ($data = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td style='text-align:center;'>$no</td>";
        echo "<td style='text-align:center;'>
                <img src='image/pengelola/" . htmlspecialchars($data['foto']) . "' width='50' height='50' style='border-radius: 50%; object-fit: cover;'>
              </td>";
        echo "<td>" . htmlspecialchars($data['no_ktp']) . "</td>";
        echo "<td>" . htmlspecialchars($data['nama']) . "</td>";
        echo "<td>" . htmlspecialchars($data['jk']) . "</td>";
        echo "<td>" . htmlspecialchars($data['usia']) . "</td>";
        echo "<td>" . htmlspecialchars($data['alamat']) . "</td>";
        echo "<td>" . htmlspecialchars($data['jabatan']) . "</td>";
        echo "<td>
                <a href='home-member.php?page=ubah-pengelola&id={$data['id']}' class='btn btn-warning btn-sm'><i class='fas fa-edit'></i></a>
                <button class='btn btn-danger btn-sm' onclick='confirmDelete({$data['id']})'><i class='fas fa-trash'></i></button>
              </td>";
        echo "</tr>";
        $no++;
    }
} else {
    echo "<tr><td colspan='9' class='text-center'>Tidak ada data ditemukan</td></tr>";
}
$koneksi->close();
