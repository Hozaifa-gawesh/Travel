jQuery(document).ready(function() {
  // PIE CHART
  new Morris.Donut({
    element: 'morris_chart_4',
    data: [
      {label: "Download Sales", value: 12},
      {label: "In-Store Sales", value: 30},
      {label: "Mail-Order Sales", value: 20}
    ]
  });
});
