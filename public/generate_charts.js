const QuickChart = require('quickchart-js');
const fs = require('fs');
const axios = require('axios');
const path = require('path');

const generateChart = async (data, title, filename) => {
  if (!data || !title || !filename) {
    throw new Error('Missing required arguments');
  }

  const chart = new QuickChart();
  chart.setConfig({
    type: 'pie',
    data: {
      labels: ['Value', 'Rest'],
      datasets: [{
        data: [data, 100 - data],
        backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(75, 192, 192, 0.2)'],
        borderColor: ['rgba(54, 162, 235, 1)', 'rgba(75, 192, 192, 1)'],
        borderWidth: 1,
      }]
    },
    options: {
      plugins: {
        title: {
          display: true,
          text: title,
        }
      }
    }
  });

  const chartUrl = chart.getUrl();
  const response = await axios.get(chartUrl, { responseType: 'arraybuffer' });

  // Ensure the directory exists
  const dir = path.dirname(filename);
  if (!fs.existsSync(dir)) {
    fs.mkdirSync(dir, { recursive: true });
  }

  fs.writeFileSync(filename, response.data);
};

const data = parseFloat(process.argv[2]);
const title = process.argv[3];
const filename = process.argv[4];

generateChart(data, title, filename).then(() => {
  console.log('Chart generated successfully');
}).catch((err) => {
  console.error('Error generating chart:', err);
});
