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

namespace Condello_Controllo_CF
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
            calcoloCodiceFiscale.CodiceFiscale codice = new calcoloCodiceFiscale.CodiceFiscale();

            output.Content = codice.CalcolaCodiceFiscale(nome.Text, cognome.Text, comune.Text, data.Text, sesso.Text);

        }
    }
}
