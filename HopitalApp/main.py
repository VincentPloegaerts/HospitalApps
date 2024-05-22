import tkinter as tk
from tkinter import messagebox
import requests

class Application(tk.Tk):
def __init__(self):
    super().__init__()
    self.title("Gestion des entrées et sorties")
    self.geometry("400x300")

    self.create_widgets()

def create_widgets(self):
    self.label = tk.Label(self, text="Admissions et Sorties du jour")
    self.label.pack(pady=10)

    self.refresh_button = tk.Button(self, text="Rafraîchir", command=self.refresh_data)
    self.refresh_button.pack(pady=10)

    self.data_listbox = tk.Listbox(self)
    self.data_listbox.pack(pady=10, fill=tk.BOTH, expand=True)

    self.refresh_data()

def refresh_data(self):
    response = requests.get('http://localhost:8000/admissions.php')
    if response.status_code == 200:
        data = response.json()
        self.data_listbox.delete(0, tk.END)
        for item in data:
            self.data_listbox.insert(tk.END, f"{item['date']} - {item['patient']} - {item['action']}")
    else:
        messagebox.showerror("Erreur", "Impossible de récupérer les données")
if name == "main":
    app = Application()
    app.mainloop()