#! /usr/bin/ruby
require 'optparse'
require 'date'

opt = OptionParser.new
params = {}
opt.on('-m VAL', '月を指定できます') {|v| params[:month] = v }
opt.on('-y VAL', '年を指定できます') {|v| params[:year] = v }
opt.parse!(ARGV)

month = params[:month].to_i
year = params[:year].to_i

start_day = Date.new(year, month, 1).day
start_wday = Date.new(year, month, 1).wday
end_day = Date.new(year, month, -1).day


puts "    #{month}月 #{year} 年"
puts "日 月 火 水 木 金 土"
print ' ' * 3 * start_wday
str = ""
(start_day..end_day).each do |date|
  if date < 10
    date = " #{date}"
  end
  str += "#{date} "
  start_wday += 1
  if start_wday % 7 ==0
    str += "\n"
  end
end
print "#{str}\n"