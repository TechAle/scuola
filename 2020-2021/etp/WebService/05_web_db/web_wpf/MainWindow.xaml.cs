using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Navigation;
using System.Windows.Shapes;
using web_wpf.ServiceReference1;

namespace web_wpf
{
    /// <summary>
    /// Logica di interazione per MainWindow.xaml
    /// </summary>
    public partial class MainWindow : Window
    {

        WebService1SoapClient service = new WebService1SoapClient();

        public MainWindow()
        {
            InitializeComponent();
            AggiornaGrid();
        }

        private void inserisci_Click(object sender, RoutedEventArgs e)
        {
            /* ottiene il numero di righe totali della tabella, in modo da
                incrementare alla riga successiva la chiave ID  */
            int ID = service.InterrogaDB().Tables[0].Rows.Count;
            ID++;
            string cognomeVal = cognome.Text;
            string nomeVal = nome.Text;
            service.CaricaDB(ID, cognomeVal, nomeVal);
            AggiornaGrid();
        }

        DataTable t;

        private void AggiornaGrid()
        {
            var data_set = service.InterrogaDB();
            t = data_set.Tables[0];
            tabella.ItemsSource = t.DefaultView;
            cognome.Text = "";
            nome.Text = "";
        }

        private void cancella_Click(object sender, RoutedEventArgs e)
        {
            String idVal = id.Text;
            if (idVal.Equals(""))
                return;
            service.EliminaDb(int.Parse(idVal));
            AggiornaGrid();
        }

        private void modifica_Click(object sender, RoutedEventArgs e)
        {
            String idVal = id.Text;
            string nomeVal = nome.Text;
            string cognomeVal = cognome.Text;
            service.ModificaDb(int.Parse(idVal), cognomeVal, nomeVal);
            AggiornaGrid();
        }

        private void Row_MouseDoubleClick(object sender, MouseButtonEventArgs e)
        {

            DataRowView row = (DataRowView)((DataGrid)sender).SelectedItem;

            if (row == null) return;
            // ( (DataRowView) ((DataGrid) sender).SelectedItem)[1]
            id.Text = row[0].ToString();
            nome.Text = row[1].ToString();
            cognome.Text = row[2].ToString();

        }

        private void filtra_Click(object sender, RoutedEventArgs e)
        {
            DataTable nuovo = new DataTable();
            nuovo.Columns.Add("id");
            nuovo.Columns.Add("cognome");
            nuovo.Columns.Add("nome");
            String inizio = cognome.Text;
            foreach (DataRow r in t.Rows)
            {
               
                if (r["cognome"].ToString().StartsWith(inizio))
                {
                    DataRow row;
                    row = nuovo.NewRow();
                    row["id"] = r["id"];
                    row["cognome"] = r["cognome"];
                    row["nome"] = r["nome"];
                    nuovo.Rows.Add(row);
                }

            }

            tabella.ItemsSource = nuovo.DefaultView;

        }
    }
}
