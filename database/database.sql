use mahasiswa;

create table users(
nim varchar(20) primary key unique,
password varchar(255) not null,
role enum('admin','user')
);

create table data_mahasiswa(
id int primary key auto_increment,
nim varchar(20) not null,
fullname varchar(255) not null,
prodi varchar(255) default "Belum terisi",
tanggal_lahir date,
nik varchar(255),
no_kk varchar(255),
tempat_lahir varchar(255),
jenis_kelamin enum('Laki-laki','Perempuan',''),
agama varchar(255),
kewarganegaraan varchar(255),
jalan varchar(255),
rt varchar(255),
rw varchar(255),
kelurahan varchar(255),
kecamatan varchar(255),
kode_pos varchar(255),
nisn varchar(255),
npwp varchar(255),
no_bpjs varchar(255),
path_foto varchar(255),
foreign key (nim) references users(nim));