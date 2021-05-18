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

namespace calcolatrice_wpf
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
        calcolatrice_servizio.calcolatrice_servizioSoapClient servizio = new calcolatrice_servizio.calcolatrice_servizioSoapClient();
        private void Button_Click(object sender, RoutedEventArgs e)
        {
            risultat0.Content = servizio.SommaNumeri(Double.Parse(num1.Text), Double.Parse(num2.Text));
        }

        private void Button_Click_1(object sender, RoutedEventArgs e)
        {
            risultat0.Content = servizio.SottraiNumeri(Double.Parse(num1.Text), Double.Parse(num2.Text));
        }

        private void Button_Click_2(object sender, RoutedEventArgs e)
        {
            risultat0.Content = servizio.MoltiplicaNumeri(Double.Parse(num1.Text), Double.Parse(num2.Text));

        }

        private void Button_Click_3(object sender, RoutedEventArgs e)
        {
            risultat0.Content = servizio.DividiNumeri(Double.Parse(num1.Text), Double.Parse(num2.Text));

        }
    }
}
