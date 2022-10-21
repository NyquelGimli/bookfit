# Nomor 1
import code


def general_stat(x1,x2,x3,x4,x5):
    sum = x1+x2+x3+x4+x5
    avg = sum / 5
    var = ((x1-avg)**2 + (x2-avg)**2 + (x3-avg)**2 + (x4-avg)**2 + (x5-avg)**2)/5
    return [sum, avg, var]

print(general_stat(12,21,13,14,5))

# Nomor 2
def general_stat2(x):
    n = len(x)
    Sum = sum(x)
    avg = Sum/n
    var = 0
    for i in x:
        var += (i - avg)**2
    
    var = var/n-1

    return ([Sum, avg, var])

print(general_stat2([12,21,13,14,5,1,-1]))

# Nomor 3
class stock:
    def __init__(self, code, date, open_price, high_price, low_price, close_price, volumn):
        self.code = code
        self.date = date
        self.open_price = open_price
        self.high_price = high_price
        self.low_price = low_price
        self.close_price = close_price
        self.volumn = volumn

    def stock_profile(self):
        print('Stock code is ' + self.code)
        print('Trading date is ' + self.date)
        print('Close price is ' + str(self.close_price))


test = stock('600001', '2015-10-21', 12.5, 13.1, 12.1, 12.3, 450000)

# test.stock_profile()

# Nomor 4
class stock2:
    def __init__(self, code, date, open_price, high_price, low_price, close_price, volumn):
        self.code = code
        self.date = date
        self.open_price = open_price
        self.high_price = high_price
        self.low_price = low_price
        self.close_price = close_price
        self.volumn = volumn

    def stock_profile(self):
        print('Stock code is ' + self.code)
        date = self.date
        str = 'Trading date is '
        print(f'{str} {date}')
        close = self.close_price
        str = 'Closing price is'
        print(f'{str} {close}')
    
    def highest_close(self):
        print(max(self.close_price))

    def highest_volumn(self):
        print(max(self.volumn))

test2 = stock('600001', '2015-10-21', 12.5, 13.1, 12.1, [12.3, 13.4], [450000, 10000])

# test2.stock_profile()