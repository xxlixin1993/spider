# spider
这是一个php写的用来当爬虫的框架。我最开始就是看见有人用python做了个爬取知乎上头像的爬虫，看着很有趣。我也想做一个爬取知乎数据然后进行分析的框架。在开发的过程中遇见了很多问题。
在写的时候，我有想过用workerman那种，起一个独立守护进程监听命令行发出的指令，然后主进程起子进程去完成爬虫任务。
后来偷懒就简单的用写了一下多进程爬取，没有具体展开去研究。如果想详细了解多进程框架可以去看worerkman

## 目录结构

- app 放业务逻辑
- comm 是公共类库
- config 放配置文件
- core 是核心实现框架的代码
- model 是获取数据层的代码

框架代码写的比较简单，以后有时间还会接着改进。

## TODO
实现以下需求

1. 网络爬虫高度可配置性。
2. 网络爬虫可以解析抓到的网页里的链接
3. 网络爬虫有简单的存储配置
4. 网络爬虫拥有智能的根据网页更新分析功能
5. 网络爬虫的效率高
6. DNS缓存　
