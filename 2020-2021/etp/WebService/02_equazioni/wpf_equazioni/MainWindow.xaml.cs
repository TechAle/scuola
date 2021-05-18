using System;
using System.Collections.Generic;
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

namespace wpf_equazioni
{
    /// <summary>
    /// Logica di interazione per MainWindow.xaml
    /// </summary>
    public partial class MainWindow : Window
    {
        public MainWindow()
        {
            InitializeComponent();
        }

        private void Button_Click(object sender, RoutedEventArgs e)
        {
            double valuea = Double.Parse(a.Text);
            double valueb = Double.Parse(b.Text);
            double valuec = Double.Parse(c.Text);
            equazioni_servizio.equazioni_servizioSoapClient servizio = new equazioni_servizio.equazioni_servizioSoapClient();
            risultato.Content = servizio.equazione(valuea, valueb, valuec);
        }
    }
}
