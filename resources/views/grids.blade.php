<x-layouts.app>
  zdsf
  <style>
      :root {
          --clr-dark: #0f172a;
          --clr-light: #f1f5f9;
          --clr-accent: #e11d48;
      }

      body {
          line-height: 1.6;
          word-spacing: 1.4px;
      }


      .container {
          display: grid;
          /*    grid-template-rows: repeat(6, 100px);
              grid-template-columns: repeat(6, 100px);*/
          width: 100%;
          margin: 0 auto;
          grid-gap: 20px 20px;
          grid-template-areas: "header header header header header"
                               "sidebar content content content content"
                               "footer footer footer footer footer";

      }

      .item {
          padding: 0.5em;
          background-color: #fb7185;
          font-weight: 700;
          color: var(--clr-light);
          border: 10px solid var(--clr-accent);
      }


      .item-1 {
          grid-row: 1 / 3;
          grid-column: 1 / 7;
      }


      .item-2 {
          grid-area: 2/4/4/6;
          z-index: 1;
      }

      .item-3 {
          grid-area: 3/1/-1/-1;
      }

      .item-4 {
          grid-area: 1/1/1/3;
      }


      #header {
          grid-area: header;
          background-color: orange;
          color: blue;
      }

      #sidebar {
          grid-area: sidebar;
          background-color: blue;
          color: red;
      }

      #content {
          grid-area: content;
          background-color: grey;
          color: white;
      }

      #footer {
          grid-area: footer;
          background-color: red;
          color: white;
      }
  </style>
  <div class="container">
    <div id="header" class="item item-1">1</div>
    <div id="sidebar" class="item item-2">2</div>
    <div id="content" class="item item-3">3</div>
    <div id="footer" class="item item-4">4</div>
  </div>
</x-layouts.app>