<?php
session_start();
include '../../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ku" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>بینینی پشكنینەكان</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    .active-tab { border-bottom: 2px solid #3b82f6; color: #3b82f6;}
    @font-face {
    font-family: 'Zain';
    src: url('../../fonts/Zain.ttf');
    }
    body {
      font-family: 'Zain', sans-serif !important;
      background: linear-gradient(135deg, #f5f7fa, #dfe9f3);
      color: #1f2937;
    }

    .glass {
      background: rgba(255, 255, 255, 0.25);
      backdrop-filter: blur(12px);
      border-radius: 1.5rem;
      box-shadow: 0 12px 32px rgba(31, 38, 135, 0.15);
      padding: 2rem;
      transition: all 0.3s ease-in-out;
    }

    .card:hover {
      transform: scale(1.02);
      box-shadow: 0 8px 28px rgba(0, 0, 0, 0.2);
    }

    .active-tab {
      border-bottom: 2px solid #6366F1;
      color: #4F46E5;
      font-family: 'Zain';
    }

    .dashboard-btn {
      background-color: #4F46E5;
      color: white;
      border-radius: 9999px;
      padding: 0.5rem 1rem;
      transition: all 0.3s ease-in-out;
    }
    .dashboard-btn:hover {
      background-color: #6366F1;
      transform: translateY(-2px) scale(1.05);
    }

    img {
      border-radius: 0.75rem;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);

    }

    .section-title {
      display: flex;
      align-items: center;
      font-size: 1.5rem;
      font-weight: bold;
      margin-bottom: 1rem;
    }

    .section-title i {
      margin-right: 0.5rem;
    }

    .section {
      border-left: 4px solid;
      padding-left: 1rem;
      margin-bottom: 2rem;
    }

    @media print {
      button {
        display: none;
      }
    }

    @keyframes fade-in {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }
    .animate-fade-in {
      animation: fade-in 0.3s ease-out;
    }
  </style>
</head>
<body class="p-4">
    <!-- Header -->
    <header class="glass max-w-7xl mx-auto mb-6 flex justify-between items-center p-4">
        <h1 class="text-3xl text-indigo-700"> پشكنینی ڕۆژانە </h1>
        <div class="flex gap-3 items-center">
            <a href="../daily_check.php" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> گەڕانەوە</a>
        </div>
    </header>
    <!-- Filter Bar -->
    <div class="glass max-w-7xl mx-auto mb-6 p-4 flex gap-4 items-center">
      <label for="yearFilter" class="font-bold">ساڵ:</label>
      <select id="yearFilter" class="p-2 rounded border border-gray-300">
        <?php for ($y = date('Y'); $y >= 2023; $y--): ?>
          <option value="<?= $y ?>"><?= $y ?></option>
        <?php endfor; ?>
      </select>

      <label for="monthFilter" class="font-bold">مانگ:</label>
      <select id="monthFilter" class="p-2 rounded border border-gray-300">
        <?php for ($m = 1; $m <= 12; $m++): ?>
          <option value="<?= $m ?>"><?= $m ?></option>
        <?php endfor; ?>
      </select>

      <button onclick="loadCheckups(1)" class="bg-blue-600 text-white px-4 py-2 rounded"> گەڕان</button>
    </div>

  <!-- Cards -->
  <div id="checkupContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 glass max-w-7xl mx-auto mb-6 flex justify-between items-center p-4"></div>

  <!-- Pagination -->
  <div id="pagination" class="mt-6 flex justify-center gap-2"></div>

  <!-- Updated Modal Design with Unique Styling -->
  <div id="modal" class="fixed inset-0 bg-black bg-opacity-75 flex justify-center items-center z-50 hidden" onclick="closeModal()">
    <div class="relative bg-white w-full max-w-4xl max-h-[90vh] overflow-y-auto rounded-2xl shadow-2xl border-2 border-blue-300 animate-fade-in p-6" onclick="event.stopPropagation()">
      
      <!-- Close and Print Buttons -->
      <div class="flex justify-between mb-4">
        <button onclick="closeModal()" class="text-red-500 font-bold text-lg hover:text-red-700 transition duration-200">✖ داخستن</button>
        <button onclick="printModal()" class="text-green-600 font-bold text-lg hover:text-green-800 transition duration-200">🖨️ پرینت</button>
      </div>

      <!-- Modal Content -->
      <div class="bg-gradient-to-br from-blue-50 to-white rounded-xl p-4 border border-gray-200">
        <h2 class="text-3xl font-extrabold text-center text-indigo-700 mb-6">📋 وردەکاری پشکنین</h2>

        <!-- Injected Content -->
        <div id="modalContent" class="space-y-6">
          <!-- Sections will be dynamically added here -->
        </div>

        <!-- Gallery -->
        <div id="image-gallery" class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-4 border-t border-gray-300 mt-6"></div>
      </div>
    </div>
  </div>

<script>
function loadCheckups(page = 1, year = null, month = null, limit = 30) {
  year = year || document.getElementById('yearFilter').value;
  month = month || document.getElementById('monthFilter').value;

  let url = `get_checkups.php?page=${page}&limit=${limit}`;
  if (year && month) {
    url += `&year=${year}&month=${month}`;
  }

  fetch(url)
    .then(res => res.json())
    .then(data => {
      const container = document.getElementById('checkupContainer');
      container.innerHTML = '';
      data.checkups.forEach(ch => {
        container.innerHTML += `
        <div class="glass پ-4 card text-center">
          <p class="text-lg font-semibold">📅 بەروار: <span class="text-blue-800">${ch.current_datetime}</span></p>
          <p class="text-s text-center mt-1">👤 بەکارهێنەر: ${ch.username}</p>
          <button onclick="openModal(${ch.id})" class="dashboard-btn mt-3">وردەکاری</button>
        </div>
        `;
      });

      const pagination = document.getElementById('pagination');
      pagination.innerHTML = '';
      for (let i = 1; i <= data.total_pages; i++) {
        pagination.innerHTML += `<button onclick="loadCheckups(${i}, ${year}, ${month}, ${limit})"
          class="px-3 py-1 rounded ${i === data.page ? 'bg-blue-600 text-white' : 'bg-gray-300'}">${i}</button>`;
      }
    });
}

document.addEventListener('DOMContentLoaded', () => {
  loadCheckups(1, null, null, 30); // Load latest 30 checkups on page load
});

const groups = [
  { title: 'مۆلیدەی 1 500KV ', icon: 'fas fa-bolt', color: 'blue-500', fields: ['gen1_load', 'gen1_temp', 'gen1_op_bar', 'gen1_fp_bar', 'gen1_hours'] },
  { title: 'مۆلیدەی 2 500KV ', icon: 'fas fa-bolt', color: 'blue-500', fields: ['gen2_load','gen2_temp', 'gen2_op_bar', 'gen2_fp_bar', 'gen2_hours'] },
  { title: 'مۆلیدەی 3 500KV ', icon: 'fas fa-bolt', color: 'blue-500', fields: ['gen3_load', 'gen3_temp', 'gen3_op_bar', 'gen3_fp_bar', 'gen3_hours'] },
  { title: 'مۆلیدەی 4 1000KV ', icon: 'fas fa-bolt', color: 'blue-500', fields: ['gen4_load', 'gen4_temp', 'gen4_op_bar', 'gen4_fp_bar', 'gen4_hours'] },
  { title: 'سوتەمەنی', icon: 'fas fa-fire', color: 'red-500', fields: ['fuel_gas', 'fuel_lpg'] },
  { title: 'ATS', icon: 'fas fa-battery-three-quarters', color: 'purple-500', fields: ['ats_load', 'ats_temp', 'ats_kw'] },
  { title: 'کارگەری ئۆکسجین', icon: 'fas fa-industry', color: 'green-600', fields: ['oxygen_compressor_bar', 'oxygen_temp', 'oxygen_hours', 'oxygen_quality', 'oxygen_dryer'] },
  { title: 'بتڵی ئۆکجسین O2', icon: 'fas fa-gas-pump', color: 'pink-600', fields: ['o2_right', 'o2_left', 'o2_out'] },
  { title: 'میکانیکی دەرەوە', icon: 'fas fa-tools', color: 'yellow-600', fields: ['boiler1', 'boiler2', 'burner1', 'burner2', 'softener', 'ro_right', 'ro_left', 'blood_status', 'dynamo1_status', 'dynamo2_status'] },
  { title: 'چیلەر', icon: 'fas fa-tint', color: 'teal-500', fields: ['chiller1_in', 'chiller1_out', 'chiller2_in', 'chiller2_out', 'chiller3_in', 'chiller3_out', 'chiller4_in', 'chiller4_out'] },
  { title: 'پارک', icon: 'fas fa-tree', color: 'green-400', fields: ['water_treatment_status', 'chlor_status', 'park_globe_status', 'pool_status'] },
  { title: 'ژوری ڤاکیۆم', icon: 'fas fa-wind', color: 'gray-600', fields: ['vacuum', 'vacuum_power', 'vacuum_temp', 'vacuum_oil'] },
  { title: 'میکانیکی قاتی (B)', icon: 'fas fa-stethoscope', color: 'blue-400', fields: ['surgery_comp_right_power', 'surgery_comp_right_temp', 'surgery_comp_left_power', 'surgery_comp_left_temp', 'teeth_comp_right_power', 'teeth_comp_right_temp', 'teeth_comp_left_power', 'teeth_comp_left_temp'] },
  { title: 'غطاسەکان', icon: 'fas fa-water', color: 'blue-700', fields: ['taqim_right_status', 'taqim_left_status', 'lab_right_status', 'lab_left_status'] },  { title: 'تانكی ئاو', icon: 'fas fa-water', color: 'blue-900', fields: ['tank1_percentage', 'tank2_percentage', 'tank3_percentage'] },
  { title: 'بەرزکەرەوەکان (مسعد)', icon: 'fas fa-elevator', color: 'orange-500', fields: ['elevator_service_status', 'elevator_surgery_status', 'elevator_forward_right_status', 'elevator_forward_left_status', 'elevator_lab_status', 'elevator_noringa_status'] },
  { title: 'UPS', icon: 'fas fa-plug', color: 'yellow-500', fields: ['ups_b_load', 'ups_b_temp', 'ups_b_split', 'ups_g_load', 'ups_g_temp', 'ups_g_split'] },
  { title: 'دافیعەکان', icon: 'fas fa-tint', color: 'blue-600', fields: ['dafia_b', 'dafia_g', 'dafia_1', 'dafia_2', 'dafia_3', 'dafia_4', 'dafia_norenga'] },
  { title: 'ژوری سێرڤەر', icon: 'fas fa-server', color: 'indigo-500', fields: ['server_split', 'server_temp', 'server_network', 'server_badala', 'server_camera', 'server_fire_system'] },
  { title: 'بەکارهێنەر و کات', icon: 'fas fa-user', color: 'green-500', fields: ['username', 'current_datetime'] },
  { title: 'تێبینی', icon: 'fas fa-sticky-note', color: 'yellow-500', fields: ['note'] }
];

const fieldLabels = {
  'gen1_load': 'لۆد',
  'gen1_temp': 'پلەی گەرمی',
  'gen1_op_bar': 'باری کارکردن OP/bar ',
  'gen1_fp_bar': 'باری فشارFP/bar ',
  'gen1_hours': 'کاتژمێری كاركردن',
  'gen2_load': 'لۆد',
  'gen2_temp': 'پلەی گەرمی',
  'gen2_op_bar': 'باری کارکردن OP/bar',
  'gen2_fp_bar': 'باری فشارFP/bar ',
  'gen2_hours': 'کاتژمێری كاركردن',
  'gen3_load': 'لۆد',
  'gen3_temp': 'پلەی گەرمی ',
  'gen3_op_bar': 'باری کارکردن OP/bar',
  'gen3_fp_bar': 'باری فشارFP/bar ',
  'gen3_hours': 'کاتژمێری كاركردن',
  'gen4_load': 'لۆد',
  'gen4_temp': 'پلەی گەرمی ',
  'gen4_op_bar': 'باری کارکردن OP/bar',
  'gen4_fp_bar': 'باری فشارFP/bar ',
  'gen4_hours': 'کاتژمێری كاركردن',
  'fuel_gas': 'گاز ',
  'fuel_lpg': 'LPG ',
  'ats_load': 'لۆدی (A)',
  'ats_temp': 'پلەی گەرمی ',
  'ats_kw': 'کێلووات',
  'oxygen_compressor_bar': 'کۆمپرێسەر pre/bar',
  'oxygen_temp': 'پلەی گەرمی',
  'oxygen_hours': 'کاتژمێری كاركردن',
  'oxygen_quality': 'نقاوە/ خاوێنی',
  'oxygen_dryer': 'درایەر',
  'o2_right': 'ئۆکسیجن لای ڕاست',
  'o2_left': 'ئۆکسیجن لای چەپ',
  'o2_out': 'دەرچوون ',
  'boiler1': 'بۆیلەر 1',
  'boiler2': 'بۆیلەر 2',
  'burner1': 'بێرنەر 1',
  'burner2': 'بێرنەر 2',
  'softener': 'سۆفتنەر',
  'ro_right': 'RO ڕاست',
  'ro_left': 'RO چەپ',
  'blood_status': 'خوێ',
  'dynamo1_status': 'دینامۆ 1',
  'dynamo2_status': 'دینامۆ 2',
  'chiller1_in': 'چیلەر 1 IN',
  'chiller1_out': 'چیلەر 1 OUT',
  'chiller2_in': 'چیلەر 2 IN',
  'chiller2_out': 'چیلەر 2 OUT',
  'chiller3_in': 'چیلەر 3 IN',
  'chiller3_out': 'چیلەر 3 OUT',
  'chiller4_in': 'چیلەر 4 IN',
  'chiller4_out': 'چیلەر 4 OUT',
  'water_treatment_status': 'وەتەر تەیمێنت',
  'chlor_status': ' کلۆر',
  'park_globe_status': 'گڵۆبی پارک',
  'pool_status': ' حەوزی پیسایی',
  'vacuum': 'ڤاکیۆم',
  'vacuum_power': 'هێزی ',
  'vacuum_temp': 'پلەی گەرمی ',
  'vacuum_oil': 'ڕۆن ',
  'surgery_comp_right_power': 'هێزی کۆمپرێسەری هەوا 1',
  'surgery_comp_right_temp': 'پلەی گەرمی کۆمپرێسەری هەوا 1',
  'surgery_comp_left_power': 'هێزی کۆمپرێسەری هەوا 2',
  'surgery_comp_left_temp': 'پلەی گەرمی کۆمپرێسەری هەوا 2)',
  'teeth_comp_right_power': 'هێزی کۆمپرێسەری هەوا 3',
  'teeth_comp_right_temp': 'پلەی گەرمی کۆمپرێسەری هەوا 3',
  'teeth_comp_left_power': 'هێزی کۆمپرێسەری هەوا 4',
  'teeth_comp_left_temp': 'پلەی گەرمی کۆمپرێسەری هەوا 4',
  'tank1_percentage': 'ڕێژەی  ئاوی تانکی 1',
  'tank2_percentage': 'ڕێژەی ئاوی تانکی 2',
  'tank3_percentage': 'ڕێژەی ئاوی تانکی 3',
  'taqim_right_status': 'تعقیم - لای ڕاست',
  'taqim_left_status': ' تعقیم - لای چەپ',
  'lab_right_status ': 'تاقیگە - لای ڕاست',
  'lab_left_status': 'تاقیگە - لای چەپ',
  'elevator_service_status': 'بەرزكەرەوە (خزمەتگوزاری)',
  'elevator_surgery_status': 'بەرزكەرەوە (نەشتەرگەری)',
  'elevator_forward_right_status': 'بەرزكەرەوە پێشەوە(ڕاست)',
  'elevator_forward_left_status': 'بەرزكەرەوە پێشەوە(چەپ)',
  'elevator_lab_status': 'بەرزكەرەوە(سۆنەر)',
  'elevator_noringa_status': 'بەرزكەرەوە(نۆڕینگە)',
  'ups_b_load': 'لۆد ',
  'ups_b_temp': 'پلەی گەرمی UPS B',
  'ups_b_split': 'سپلیت UPS B',
  'ups_g_load': 'لۆد',
  'ups_g_temp': 'پلەی گەرمی UPS G',
  'ups_g_split': 'سپلیت UPS G',
  'dafia_b': 'دافیعەی قاتی B',
  'dafia_g': 'دافیعەی قاتی G',
  'dafia_1': 'دافیعەی قاتی 1',
  'dafia_2': 'دافیعەی قاتی 2',
  'dafia_3': 'دافیعەی قاتی 3',
  'dafia_4': 'دافیعەی قاتی 4',
  'dafia_norenga': 'دافیعەی نۆرینگە',
  'server_split': 'سپلیت',
  'server_temp': 'پلەی گەرمی ژور ',
  'server_network': 'نێتوۆرك',
  'server_badala': 'بەدالە',
  'server_camera': 'کامێرا',
  'server_fire_system': 'سیستەمی ئاگرکەوتنەوە',
  'username': 'كارمەند',
  'current_datetime': 'بەروار',
  'note': 'تێبینی'
};

function openModal(id) {
  fetch(`get_checkup_detail.php?id=${id}`)
    .then(res => res.json())
    .then(data => {
      const modalContent = document.getElementById('modalContent');
      modalContent.innerHTML = '';

      groups.forEach(group => {
        const section = document.createElement('div');
        section.classList.add('section', `border-${group.color}`);
        section.innerHTML = `
          <div class="section-title text-${group.color}">
            <i class="${group.icon}"></i> ${group.title}
          </div>
        `;

        group.fields.forEach(field => {
          const fieldElement = document.createElement('p');
          fieldElement.classList.add('text-2xl', 'font-bold', 'text-black-900', 'mb-4', 'border-2');
          const fieldLabel = fieldLabels[field] || field.replace(/_/g, ' ');
          fieldElement.innerHTML = `<strong>${fieldLabel}:</strong> <span id="${field}" class="text-2xl font-bold text-blue-700 mb-4"></span>`;
          section.appendChild(fieldElement);
        });

        modalContent.appendChild(section);
      });

      Object.keys(data).forEach(key => {
        const element = document.getElementById(key);
        if (element) {
          element.innerText = data[key];
        }
      });

      // Render image links
      const gallery = document.createElement('div');
      gallery.id = 'image-gallery';
      gallery.className = 'grid grid-cols-2 md:grid-cols-4 gap-4';
      const files = Array.isArray(data.files) ? data.files : data.files.split(",").map(f => f.trim());
      files.forEach(url => {
        const link = document.createElement("a");
        link.href = url;
        link.target = "_blank";
        link.className = "text-blue-600 underline hover:text-blue-800";
        link.textContent = decodeURIComponent(url); // Decode URL to ensure proper display
        gallery.appendChild(link);
      });
      modalContent.appendChild(gallery);

      document.getElementById('modal').classList.remove('hidden');
    });
}

function closeModal() {
  document.getElementById('modal').classList.add('hidden');
}

// Ensure modal closes when clicking outside of it
document.getElementById('modal').addEventListener('click', (event) => {
  if (event.target.id === 'modal') {
    closeModal();
  }
});

function printModal() {
  const modalContent = document.getElementById("modalContent").innerHTML; // تەنها ناوەڕۆکی گرنگ

  const win = window.open('', '', 'width=900,height=650');
  win.document.write(`
    <html lang="ku" dir="rtl">
      <head>
        <title> پشكنینی ڕۆژانە</title>
        <style>
          body {
            font-family: 'Zain', sans-serif;
            direction: rtl;
            padding: 40px;
            background: #f9fafb;
            color: #111827;
          }
          h2 {
            text-align: center;
            color: #1d4ed8;
            font-size: 28px;
            margin-bottom: 24px;
          }
          .section {
            margin-bottom: 30px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
          }
          .section-title {
            font-size: 20px;
            font-weight: bold;
            color: #2563eb;
            margin-bottom: 10px;
            border-bottom: 1px solid #d1d5db;
            padding-bottom: 8px;
          }
          p {
            margin: 6px 0;
            font-size: 16px;
          }
        </style>
      </head>
      <body>
        <h2>📋 وردەکاری پشکنین</h2>
        ${modalContent} <!-- تەنها ناوەڕۆکی گرنگ -->
      </body>
    </html>
  `);
  win.document.close();
  win.focus();
  win.print();
  win.close();
}


window.onload = () => loadCheckups(1);
</script>

</body>
</html>
